<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
//リレーション(多対多のメソッド)
 public function users() {
    return $this->belongsToMany(User::class);
 }
}
