<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TagsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
         //$this->middleware('auth')->except('index', 'create');
        // $this->middleware('auth')->only('index', 'create');
    }

    public function index()
    {
        //
        // if (!Gate::allows('tags.view')) {
        //     abort(403);
        // }
        Gate::authorize('tags.view');
        //
        $tags = Tag::paginate();
        // dd($tags);
        return view('tags.index ', [
            'title' => 'Tags List',
            'tags' =>   $tags,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        //
        if (!Gate::allows('tags.create')) {
            abort(403);
        }
        //Gate::authorize('tags.create');
        //
        return view('tags.create', [
            'tag' => new Tag(),
        ]);
    }

    public function store(TagRequest $request)
    {

        // $this->validateRequest($request);

        // $tag = new Tag();
        // $tag->name = $request->input('name');
        // $tag->slug = str::slug($request->name);
        // $tag->save();
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        //2
        //dd($request->all());
        $tag = Tag::create($request->all());
        // $tag = Tag::create([
        //     'name' => $request->input('name'),
        //     'slug' => Str::slug($request->name),
        // ]);
        //3 
        // $tag = new Tag($request->all());
        // $tag->save();
        //4
        // $tag = new Tag();
        // $tag->forceFill($request->all())->save();
        //prg    post redirect get

        //Session::flash('success', 'Tag Created');
        Session::flash('info', $tag->name);

        return redirect('/tags'); //->with('success', 'Tag Created')
    }

    public function edit($id)
    {
        //
        if (!Gate::allows('tags.edit')) {
            abort(403);
        }

        //Gate::authorize('tags.edit');
        //
        //dd($id);
        //   $Tag = Tag::where('id','=',$id)->first();
        $tag = Tag::findORfail($id);
        // if ($tag == null) {
        //   abort(404);
        // }
        // dd($tag);

        return view('tags.edit', [
            'tag' => $tag,
        ]);
    }
    // public function update(Request $request, $id)
    public function update(Request $request, $id)
    {

        // $rules = [
        //     'name' => ['required', 'string', 'between:3,255', "unique:tags,name,$id"],
        // ];
        // $validator = Validator::make(
        //     $request->all(),
        //     $rules,

        // );

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }


        //1
        //$this->validateRequest($request, $id);
        //2
        $data = $this->validateRequest($request, $id);


        $tag = Tag::findORfail($id);
        //1
        // $tag->name = $request->input('name');
        // $tag->slug = Str::slug($request->input('name'));
        // $tag->save();
        //2
        $tag->update([
            //1
            //'name' => $request->input('name'),
            //2
            'name' => $data['name'],
            'slug' => Str::slug($request->input('name')),
        ]);

        // Session::flash('success', 'Tag Updated');
        Session::flash('info', $tag->name);

        return redirect('/tags'); //->with('success', 'Tag Updated');
    }
    public function destroy($id)
    {

        if (!Gate::allows('tags.destroy')) {
            abort(403);
        }

        //1
        Tag::destroy($id);

        //2
        // Tag::where('id', '=', $id)->delete;

        //3
        // $tag = Tag::findOrfail($id);
        // $tag->delete;



        return redirect('/tags'); //->with('success', 'Tag Deleted')
    }

    protected function validateRequest(Request $request, $id = 0)
    {
        $rules = [
            'name' => ['required', 'string', 'between:3,255', "unique:tags,name,$id"],
        ];
        $messages = [
            'required' => 'The input field :attribute is mandatory',
        ];
        //1
        // $request->validate($rules, $messages);
        //2
        //$this->validate($request, $rules, $messages);


        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages,
            [
                'name' => 'Tag Name'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back();
        }
        $clean =  $validator->validate();

        return $clean;
    }
}
