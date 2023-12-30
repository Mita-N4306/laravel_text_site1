<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *w
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    //投稿(複数＝posts)とユーザーの関連付け
    public function posts() {
     return $this->hasMany(Post::class);
    }
    //コメント投稿(１人のユーザーに対して複数のコメントを持つ)->メソッドを複数形に推奨(comments)
    public function comments() {
     return $this->hasMany(Comment::class);
    }
    //リレーション(多対多のメソッド)
    public function roles() {
     return $this->belongsToMany(Role::class);
    }
}
