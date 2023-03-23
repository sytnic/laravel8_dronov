<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bb extends Model
{
    //use HasFactory;

    // Массив с именами полей, доступных для массового присваивания
    protected $fillable = ['title', 'content', 'price'];
}
