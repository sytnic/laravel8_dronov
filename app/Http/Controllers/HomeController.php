<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bb;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['bbs' => Auth::user()->bbs()->latest()->get()]);
        // Auth::user() вызывает объект класса User
    }

    // выведет страницу с веб-формой для создания объявления
    public function showAddBbForm() {
        return view('bb_add');
    }

    // сохранит созданное объявление
    public function storeBb(Request $request) {
        // свойства request берутся из Html-формы
        Auth::user()->bbs()->create(
            ['title'   => $request->title,
             'content' => $request->content,
             'price'   => $request->price]);

        return redirect()->route('home');
    }

    // выведет страницу с веб-формой для редактирования
    public function showEditBbForm(Bb $bb) {
        return view('bb_edit', ['bb' => $bb]);
    }

    // сохранит отредактированное объявление
    public function updateBb(Request $request, Bb $bb) {
        $bb->fill(['title' => $request->title,
                   'content' => $request->content,
                   'price' => $request->price]);
        $bb->save();
        return redirect()->route('home');
    }
    
    // вывод страницы удаления объявления
    public function showDeleteBbForm(Bb $bb) {
        return view('bb_delete', ['bb' => $bb]);
    }

    // удаление
    public function destroyBb(Bb $bb) {
        $bb->delete();
        return redirect()->route('home');
    }

}
