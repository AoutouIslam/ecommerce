<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Article;
use  App\Models\Favori;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //


    public function index(Request $request)
    {
        //dd($request->get('sort'));
        $category = "";
        $sort ="";
        $sort_by = "";
        if($request->get('category') == "All")
        {
            $category = "All";
        }
        if($request->get('category') == "cuissine")
        {
            $category = "cuissine";
        }else if($request->get('category') == "salle de bain")
        {
            $category = "salle de bain";
        }else if($request->get('category') == "chambre")
        {
            $category = "chambre";
        }else if($request->get('category') == "decoration")
        {
            $category = "decoration";
        }else{
            $category = "All";
        }

        if($request->get('sort') == 'partinence'){
            $sort = "nombre_vues";
            $sort_by = "desc";
        }else if($request->get('sort') == 'new')
        {
            $sort = "created_at";
            $sort_by = "desc";
        }else if($request->get('sort') == 'price_asc')
        {
            $sort = "prix_vente";
            $sort_by = "asc";
        }else if($request->get('sort') == 'price_desc')
        {
            $sort = "prix_vente";
            $sort_by = "desc";
        }else{
            $sort = "nombre_vues";
            $sort_by = "desc";
        }


    if($category == "All"){
        if($sort == "prix_vente"){
            if($sort_by == "asc"){
                $price = "";
                $articles = Article::with(['demensions'=> function ($query) use($sort_by) {
               $query->orderBy('prix_vente',$sort_by);
                }])->where('disponibility','En Stock')->paginate(12)->appends(['sort',$request->get('sort'),'category' => $category]); // COllections
                //dd($articles);
                $test =  Article::with(['demensions'=> function ($query) use($sort_by) {
                    $query->orderBy('prix_vente',$sort_by);
                     }])->where('disponibility','En Stock')->paginate(12)->appends(['sort',$request->get('sort'),'category' => $category]);


                return view('article/article',[
                            'articles' => $articles,
                            'category' => $category,
                            'sort' => $request->get('sort'),
                        ]);

            }else{
                $articles = Article::with(['demensions'=> function ($query) use($sort_by) {
                    $query->orderBy('prix_vente' ,$sort_by);
                }])->where('disponibility','En Stock')->paginate(12)->appends(['sort',$request->get('sort'),'category' => $category]); // COllections
                //dd($articles);

                return view('article/article',[
                            'articles' => $articles,
                            'category' => $category,
                            'sort' => $request->get('sort'),
                        ]);
            }

            }else{
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy($sort,$sort_by)->paginate(12)->appends(['sort',$request->get('sort'),'category' => $category]); // COllections
                        return view('article/article',[
                            'articles' => $articles,
                            'category' => $category,
                            'sort' => $request->get('sort'),
                        ]);
            }
    }else{
        if($sort == "prix_vente"){
            if($sort_by == "asc")
            {
                $articles = Article::with(['demensions'=> function ($query) use($sort_by) {
                    $query->orderBy('prix_vente' ,$sort_by)->oldest();
                }])->where('disponibility','En Stock')->where('category',$category)->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections

                //dd($articles);

                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }else{
                $articles = Article::with(['demensions'=> function ($query) use($sort_by) {
                    $query->orderBy('prix_vente' ,$sort_by);
                }])->where('disponibility','En Stock')->where('category',$category)->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
//dd($articles);

                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }
        }else{
            $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)->orderBy($sort,$sort_by)->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections

            return view('article/article',[
            'articles' => $articles,
            'category' => $category,
        ]);
        }
        $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)->orderBy($sort,$sort_by)->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
        return view('article/article',[
            'articles' => $articles,
            'category' => $category,
        ]);
    }


        //sort by category
        if($category == "All")
        {

            if($request->get('sort') == 'new')
            {

            $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('created_at','desc')->paginate(12)->appends('sort',$request->get('sort')); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                    'sort' => $request->get('sort'),
                ]);
            }else if($request->get('sort') == 'price_desc')
            {

                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('demensions','desc')
                ->paginate(12)->appends('sort',$request->get('sort'));
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                    'sort' => $request->get('sort'),
                ]);
            }else if($request->get('sort') == 'price_asc')
            {

                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('prix_vente','asc')
                ->paginate(12)->appends('sort',$request->get('sort')); // COllections
                 return view('article/article',[
                     'articles' => $articles,
                     'category' => $category,
                     'sort' => $request->get('sort'),
                 ]);
            }else if($request->get('sort') == "partinence"){

                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('nombre_vues','desc')
                ->paginate(12)->appends(['sort' =>$request->get('sort')]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                    'sort' => $request->get('sort'),
                ]);


            }else{

                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('nombre_vues','desc')
                ->paginate(12)->appends(['sort' =>$request->get('sort')]); // COllections

                //dd("you are here");
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                    'sort' => $request->get('sort'),
                ]);
            }
        }else{
            if($category == "All"){
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)->orderBy('nombre_vues','desc')
                ->paginate(12)->appends(['sort' =>$request->get('sort')]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                    'sort' => $request->get('sort'),
                ]);
            }else if($request->get('sort') == 'new')
            {
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)->orderBy('created_at','desc')
                ->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }else if($request->get('sort') == 'price_desc')
            {
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)
                ->orderBy('prix_vente','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }else if($request->get('sort') == 'price_asc')
            {
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)
                ->orderBy('prix_vente','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }else if($request->get('sort') == "partinence"){
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->where('category',$category)
                ->orderBy('nombre_vues','desc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }else{
                $articles = Article::with(['demensions'])->where('disponibility','En Stock')->orderBy('nombre_vues','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article/article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }
        }

        /*if($request->get('sort') == 'new')
        {
            if($category == "All"){

                $articles = Article::where('disponibility','En Stock')->orderBy('created_at','desc')->paginate(12)->appends('sort',$request->get('sort')); // COllections
                return view('article\article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }else{
                $articles = Article::where('disponibility','En Stock')->where('category',$category)->orderBy('created_at','desc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article\article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }

        }else if($request->get('sort') == 'price_desc')
        {
            if($category == "All"){
            $filter = 'price_desc';
            $articles = Article::where('disponibility','En Stock')->orderBy('prix_vente','desc')
            ->paginate(12)->appends('sort',$request->get('sort')); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
            }else{
                $articles = Article::where('disponibility','En Stock')->where('category',$category)->orderBy('prix_vente','desc')
                ->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
                return view('article\article',[
                    'articles' => $articles,
                    'category' => $category,
                ]);
            }
        }else if($request->get('sort') == 'price_asc')
        {
            if($category == "All"){
            $filter = 'price_asc';
           $articles = Article::where('disponibility','En Stock')->orderBy('prix_vente','asc')
           ->paginate(12)->appends('sort',$request->get('sort')); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
        }else{
            $articles = Article::where('disponibility','En Stock')->where('category',$category)
            ->orderBy('prix_vente','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
        }
        }else if($request->get('sort') == "partinence"){

            if($category == "All"){
            $articles = Article::where('disponibility','En Stock')->orderBy('nombre_vues','desc')
            ->paginate(12)->appends(['sort' =>$request->get('sort')]); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
        }else{
            $articles = Article::where('disponibility','En Stock')->where('category',$category)
            ->orderBy('nombre_vues','desc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
        }
        }else{
            if($category == "All"){
            $articles = Article::where('disponibility','En Stock')->orderBy('nombre_vues','asc')
            ->paginate(12)->appends(['sort' =>$request->get('sort')]); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
        }else{
            $articles = Article::where('disponibility','En Stock')->orderBy('nombre_vues','asc')->paginate(12)->appends(['sort' =>$request->get('sort'),'category' => $category]); // COllections
            return view('article\article',[
                'articles' => $articles,
                'category' => $category,
            ]);
        }
        }*/

    }
   /* public function searchProduct(Request $request)
    {

        dd("you are in the search product results in the article controller");
       $search = $request->input('searchBox');
        $searched_article = Article::where('nom_article','like','%'.$search.'%')->paginate(12);
        //dd("you search for " . $search);
        return view("/article/searchArticle")->with(['search' => $search,'articles' => $searched_article]);
    }*/

    public function search(Request $request)
    {

            dd("you are in the search results");
        //$search = $request->input('search');
        ///$searched_article = Article::where('nom_article','like','%'.$search.'%')->limit(4)->get();
        //return response()->json([ $searched_article]);

    }


}
