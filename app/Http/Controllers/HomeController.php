<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status',1)->orderByDesc('id')->get()->take(10);
        return view('homepage', compact('categories'));
    }
}
