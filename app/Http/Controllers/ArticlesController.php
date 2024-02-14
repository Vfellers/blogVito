<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(){
        return view("blog/articles", [
            "articles" => Articles::paginate(10)
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
