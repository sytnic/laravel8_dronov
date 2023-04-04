<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bb extends Model
{
    //use HasFactory;

    // Массив с именами полей, доступных для массового присваивания
    protected $fillable = ['title', 'content', 'price'];

    /**
     * Создание в Bb связи между моделями Bb и User,
     * "многие" на стороне таблицы bbs,
     * "один" на стороне таблицы users
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
