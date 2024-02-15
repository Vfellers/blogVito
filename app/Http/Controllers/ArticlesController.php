<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Fazer a pesquisa --------------------------

    public function index(){
        $search = request("search");                        //sEARCH vem do name no imput de nav.blade
        if ($search) {
            $articles = Articles::where([
                ["title", "like", "%{$search}%"]
            ])->paginate(10);
        } else{

            $articles = Articles::paginate(10);
        }


    // -------------------------------------------


        return view("blog/articles", [
            "articles" => $articles,
            "search" => $search
        ]);
    }


    public function detail($id){
        $article = Articles::where("id", $id)->firstOrFail();                                           //definiu a variavel $article
        $others = Articles::whereNot("id", $id)->orderBy("id", "desc")->limit(4)->get();                //pega qualquer id que nao seja o atual e só os 4 ultimos

        return view("blog/article", [                                                                   // puxa $article na posiçao article do array e others tabem
            "article" => $article,
            "others" => $others
        ]);                                           
    }
}
