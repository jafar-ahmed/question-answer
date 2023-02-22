<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Profiler\Profile;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id', 'status'
    ];
    // One to Many  (Question has Many Answers)
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $hidden = [
        //'updated_at',
    ];

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,         //Related model
            //  ممكن ينضفافو او لا لانه نفس تسمية لارافل
            // 'question_tag',     //pivot table
            // 'question_id',      //F.K for current model in pivot table
            // 'tag_id',           //F.K for current model in pivot table
            // 'id',               //P.K for current model
            // 'id'               //P.K for current model
        );
    }
}
