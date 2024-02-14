<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("blog/home", [
            // "articles" => Articles::all() //Consultando o metodo all que tras todos os registros da tabela e traz pra mim i qye esta na tabela articles madando pra dentro daview HOME
            // "articles" => Articles::inRandomOrder()->limit(3)->get()     //Puxa 3 registros de forma randomica
            "articles" => Articles::orderBy("id", "desc")->limit(3)->get()      //Pega os 3 ultimos registros por id e ordem decrescente, nesse caso as ultimas noticias
        ]);
    }
}
