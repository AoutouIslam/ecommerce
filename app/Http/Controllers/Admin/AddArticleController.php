<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Article;
use App\Models\DemensionArticle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AddArticleController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    public function index()
    {
        $user = Auth::user();
        if($user->type != "admin")
        {
            return redirect("home");
        }else{
            return view('Admin/addarticle');
        }
    }

    public function store(Request $request)
    {
        //dd($request->Stock);
        $data[] = '';
        // validate the input
        $this->validate($request,[
            'Ref'        => ['required','unique:articles,ref_article'],
            'NomArticle' => 'required| max:255',
            'Description' => 'required',
            'category' => 'required',
            'demensionX1' => 'required|numeric|max:255',
            'demensionY1' => 'required|numeric|max:255',
            'demensionZ1' => 'required|numeric|max:255',
            'ColorArticleA' => 'required',
           // 'prixAchat'      => 'required|numeric',
            //'prixArticle' => 'required|numeric',
        ],);
        $colors = "[";
        $countMiscs = 0;
        $MiscA = false;
        $MiscB = false;
        $MiscC = false;
        $images_Misc = [];

        $colors = $colors . $request->ColorArticleA;

        if($request->checkboxB)
        {
            $colors = $colors . ";" . $request->ColorArticleB;
        }
        if($request->checkboxC)
        {
            $colors = $colors . ";" . $request->ColorArticleC;
        }
        if($request->checkboxD)
        {
            $colors = $colors . ";" . $request->ColorArticleD;
        }
        if($request->checkboxE)
        {
            $colors = $colors . ";" . $request->ColorArticleE;
        }
        if($request->checkboxF)
        {
            $colors = $colors . ";" . $request->ColorArticleF;
        }
        $colors = $colors . "]";




        if($request->checkboxMiscA || $request->checkboxMiscB || $request->checkboxMiscC)
        {
            $request->checkboxMiscA ? $MiscA = true  : $MiscA = false;
            $request->checkboxMiscB ? $MiscB = true : $MiscB = false;
            $request->checkboxMiscC ? $MiscC = true: $MiscC = false;
        }



        $last_inserted_item = Article::latest()->first();
        $last_inserted_id = $last_inserted_item == null ? 1 :  $last_inserted_item->id + 1;


        if($MiscA)
        {
            $countMiscs++;
            if($request->hasfile('MiscA'))
         {
                $file  = $request->file("MiscA");
                $name = time().rand(1,100) . Str::random(25) . '.'.$file->extension();
                $file->move(public_path('files/articles/article_'.$last_inserted_id . '/Misc'), $name);
                $images_Misc[] = $name;

            $messageA = 'Misc A successfully uploaded ';
         }
            else{
             $messageA =  'an error has occured While inserting Misc A';
         }
        }


        if($MiscB)
        {
            $countMiscs++;
            if($request->hasfile('MiscB'))
         {
                $file  = $request->file("MiscB");
                $name = time().rand(1,100) . Str::random(25) . '.'.$file->extension();
                $file->move(public_path('files/articles/article_'.$last_inserted_id . '/Misc'), $name);
               $images_Misc[] = $name;
            $messageB = ' Misc B successfully uploaded ';
         }
            else{
             $messageB=  'an error has accured While uploading Misc B';
         }
        }

        if($MiscC)
        {
            $countMiscs++;
            if($request->hasfile('MiscC'))
         {
                $file = $request->file('MiscC');
                $name = time().rand(1,100) . Str::random(25) . '.'.$file->extension();
                $file->move(public_path('files/articles/article_'.$last_inserted_id . '/Misc'), $name);
                $images_Misc[] = $name;

            $messageC = ' Misc Csuccessfully uploaded';
         }
            else{
             $messageC =  'an error has accured While uploading Misc';
         }
        }

        $image_location = "";
        $message = '';

        $files = [];


        if($request->hasfile('documents'))
         {
            foreach($request->file('documents') as $file)
            {
                $name = time().rand(1,100) . Str::random(25) . '.'.$file->extension();
                $file->move(public_path('files/articles/article_'.$last_inserted_id.'/images'), $name);
                $files[] = $name;
                $image_location = 'files/articles/article_'.$last_inserted_id;
            }
            $message = 'successfully uploaded '. count($files) . ' files';
         }
  else{
             $message =  'an error has accured';
         }


         // store article


         $stock  = "no";

         if($request->Stock != null)
         {
             echo "there is a stock";
            $stock = "yes";
         }
         $article = Article::create([
            'ref_article' => $request->Ref,
            'article_salt' => Hash::make(time() . rand(1,1000) . Str::random(40) . $request->Ref),
            'nom_article' => $request->NomArticle,
            'description' => $request->Description,
            'category' => $request->category,
            'color' => $colors,
            'prix_achat' => $request->prixAchat,
            'prix_vente' => $request->prixArticle,
            'misc' => json_encode($images_Misc),
            'image_location' => $image_location,
            'images_article' => json_encode($files),
            'stock_limit' => $request->Stock,
            'stock'     => $stock,
            ]
        );

        $demension = "[". $request->demensionX1 ."," . $request->demensionY1 ."," .$request->demensionZ1;
                    DemensionArticle::create(
                        [
                        'article_id' => $article->id,
                        'demension_salt' => Hash::make(time() . rand(1,1000) . Str::random(40) .$request->demensionX1 ."," . $request->demensionY1 ."," .$request->demensionZ1),
                        'demension' => $request->demensionX1 ."," . $request->demensionY1 ."," .$request->demensionZ1,
                        'prix_achat' => $request->demension1PrixAchat,
                        'prix_vente' => $request->demension1PrixVente,
                        ]
                    );
        if($request->demensionX2 != null && $request->demensionY2 && $request->demensionZ2)
        {
           $demension  = $demension . ";" . $request->demensionX2 . "," . $request->demensionY2 . "," . $request->demensionZ2;
           DemensionArticle::create(
               [
                'article_id' => $article->id,
                'demension_salt' => Hash::make(time() . rand(1,1000). Str::random(40) .$request->demensionX2 ."," . $request->demensionY2 ."," .$request->demensionZ2),
                'demension' => $request->demensionX2 ."," . $request->demensionY2 ."," .$request->demensionZ2,
                'prix_achat' => $request->demension2PrixAchat,
                'prix_vente' => $request->demension2PrixVente,
               ]
            );
        }
        if($request->demensionX3 != null && $request->demensionY3 && $request->demensionZ3)
        {
           $demension  = $demension . ";" . $request->demensionX3 . "," . $request->demensionY3 . "," . $request->demensionZ3;
           DemensionArticle::create(
            [
             'article_id' => $article->id,

             'demension_salt' => Hash::make(time() .  rand(1,1000) . Str::random(40) .$request->demensionX3 ."," . $request->demensionY3 ."," .$request->demensionZ3),
             'demension' => $request->demensionX3 ."," . $request->demensionY3 ."," .$request->demensionZ3,
             'prix_achat' => $request->demension3PrixAchat,
             'prix_vente' => $request->demension3PrixVente,
            ]
         );
        }
        if($request->demensionX4 != null && $request->demensionY4 && $request->demensionZ4)
        {
           $demension  = $demension .";" . $request->demensionX4 . "," . $request->demensionY4 . "," . $request->demensionZ4;
           DemensionArticle::create(
            [
             'article_id' => $article->id,
             'demension_salt' => Hash::make(time() . rand(1,1000). Str::random(40) .$request->demensionX4 ."," . $request->demensionY4 ."," .$request->demensionZ4),
             'demension' => $request->demensionX4 ."," . $request->demensionY4 ."," .$request->demensionZ4,
             'prix_achat' => $request->demension4PrixAchat,
             'prix_vente' => $request->demension4PrixVente,
            ]
         );
        }
        $demension  = $demension  . "]";
        if($article != null)
        {
            return back()->with('message','article Ajouter avec succes');
        }else{
            return back()->with('message','Une erreur sest produit');
        }

        // redirect

    }
}
