<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('nombre_vues','desc')->paginate(12); // COllections
        return view('home',[
            'articles' => $articles
        ]);
    }
}
