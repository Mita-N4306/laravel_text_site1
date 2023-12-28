<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    //投稿とユーザーの関連付け(1つの投稿が１人のユーザーに属する)
    public function user() {
     return $this->belongsTo(User::class);
    }
    protected $fillable = [
     'title',
     'body',
     'user_id',
     'image',
    ];
    //コメント投稿(１つの投稿に対して複数のコメントが来る可能性がある)->メソッドを複数形に推奨(comments)
    public function comments() {
     return $this->hasMany(Comment::class);
    }
}
