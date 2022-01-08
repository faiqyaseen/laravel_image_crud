<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id'
    ];

    public static function getPosts($where = [])
    {
        $query = self::select('posts.*', 'users.name as user_name', 'users.email as user_email')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->where($where)
            ->get();

        return $query;
    }
}
