<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin/artigos/articles", [
            "articles" => Articles::OrderBy("id", "desc")->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("admin/artigos/create", [
            "categorias" => Categories::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = new Articles;
        $article->title = $request->title;
        $article->preview = $request->preview;
        $article->author = $request->author;
        $article->text = $request->text;
        $article->from_categories = $request->from_categories;
        $article->date = date("Y-m-d h:i:s");


        //-------- upload imagem: ----------
        if($request->hasFile("image") && $request->file("image")->isValid()){
            $name = strtotime("now").".".$request->image->extension();            //Nome que ele vai dar pra imagem, é um timestamp.jpg ou a extensão que a imagem tiver
            $request->image->move(public_path("upload"), $name);                    //criou a pasta upload em public, onde ficara as imagens (nosso esta como img)
            $article->image = $name;
        }

        $article->save();
        return redirect("/admin/artigos")->with("success", "Registro inserido com sucesso.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("admin/artigos/edit", [
            "categorias" => Categories::all(),
            "article" => Articles::findOrFail("$id")
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Articles::find($id);
        $article->title = $request->title;
        $article->preview = $request->preview;
        $article->author = $request->author;
        $article->text = $request->text;
        $article->from_categories = $request->from_categories;

        //upload imagem

        $imgAtual = $article->image;

        if($request->hasFile("image") && $request->file("image")->isValid()){      
             
            if(file_exists(public_path("upload/").$imgAtual)){                    //Deletar a imagem atual do banco se for trocar na edição 
                unlink(public_path("upload/").$imgAtual);
            }

            $name = strtotime("now").".".$request->image->extension();              //Nome que ele vai dar pra imagem, é um timestamp.jpg ou a extensão que a imagem tiver
            $request->image->move(public_path("upload"), $name);                    //criou a pasta upload em public, onde ficara as imagens (nosso esta como img)
            $article->image = $name;
        }

        $article->update();
        return redirect("/admin/artigos")->with("success", "Registro Atualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $art = Articles::find($id);

        //Verificar se existe imagem pra deletar
        if(file_exists(public_path("upload/").$art->image)){
            //deletar a imagem do banco no delete
            unlink(public_path("upload/").$art->image);
        }

        $art->delete();
        return redirect("/admin/artigos")->with("success", "Registro Deletado.");
    }
}
