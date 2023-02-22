<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    //تكون مضافة افتراضيا
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';

    // protected $table = 'tags';

    // protected $primarykey = 'id';

    // protected $keyType = 'int';

    // public $increminting = true;

    // public $timestamps = true;

    //2
    protected $fillable = [
        'name', 'slug'
    ];

    public function questions()
    {
        return $this->belongsToMany(
            Question::class,
            'question_tag',
            'tag_id',
            'question_id',
            'id',
            'id'
        );
    }
}
