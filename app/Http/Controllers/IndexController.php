<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * Home Page
     */
    public function index()
    {
        return view('index');
    }
}
