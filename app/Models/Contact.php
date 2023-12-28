<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [   //$fillable=大量代入を許可するプロパティ
        'title',
        'body',
        'email',
    ];
}
