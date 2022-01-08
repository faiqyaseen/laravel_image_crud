<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'post_id'
    ];

    public static function getComments($where = [])
    {
        $query = self::select('comments.*', 'posts.title AS post_title')
            ->leftJoin('posts', 'posts.id', '=', 'comments.post_id')
            ->where($where)
            ->get();

        return $query;
    }
}
