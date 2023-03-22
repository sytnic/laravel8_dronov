<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;

class BbsController extends Controller
{
    public function index() {
        return response('Здесь будет перечень объявлений.')
        ->header('Content-Type', 'text/plain');
    }
}
