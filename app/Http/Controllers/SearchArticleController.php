<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class SearchArticleController extends Controller
{
    //
    public function index(Request $request)
    {
      /*$search = $request->search;
        $searched_article = Article::where('nom_article','like','%'.$search.'%')->paginate(12);
        //dd("you search for " . $search);
        return view("/article/searchArticle")->with(['search' => $search,'articles' => $searched_article]);*/
    }

    public function searchProduct(Request $request)
    {

        //dd("you are in the search product results of the search Controller");
        $search = $request->input('searchBox');
        if($request->get('sort') == 'new')
        {
            $articles = Article::where('disponibility','En Stock')->where('nom_article','like','%'.$search. '%')->orderBy('created_at','desc')
            ->paginate(12)->appends(['sort' =>$request->get('sort'),'search' => $search]); // COllections
            return view('article\searchArticle',[
                'articles' => $articles,
                'search' => $search,
            ]);
        }
        if($request->get('sort') == 'price_desc')
        {
            $articles = Article::where('disponibility','En Stock')->where('nom_article','like','%'.$search. '%')->orderBy('prix_vente','desc')
            ->paginate(12)->appends(['sort' =>$request->get('sort'),'search' => $search]); // COllections
            return view('article\searchArticle',[
                'articles' => $articles,
                'search' => $search,
            ]);
        }else if($request->get('sort') == 'price_asc')
        {
            $articles = Article::where('disponibility','En Stock')->where('nom_article','like','%'.$search. '%')
            ->orderBy('prix_vente','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'search' => $search]); // COllections
            return view('article\searchArticle',[
                'articles' => $articles,
                'search' => $search,
            ]);
        }else if($request->get('sort') == "partinence"){
            $articles = Article::where('disponibility','En Stock')->where('nom_article','like','%'.$search. '%')
            ->orderBy('nombre_vues','desc')->paginate(12)->appends(['sort' =>$request->get('sort'),'search' => $search]); // COllections
            return view('article\searchArticle',[
                'articles' => $articles,
                'search' => $search,
            ]);
        }else{
            $articles = Article::where('disponibility','En Stock')->where('nom_article','like','%'.$search. '%')
            ->orderBy('nombre_vues','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'search' => $search]); // COllections
            return view('article\searchArticle',[
                'articles' => $articles,
                'search' => $search,
            ]);
        }
        //return view("/article/searchArticle")->with(['search' => $search,'articles' => $searched_article]);
    }
}
