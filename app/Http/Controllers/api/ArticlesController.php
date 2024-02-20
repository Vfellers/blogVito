<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticlesResource;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

class ArticlesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ArticlesResource::collection(Articles::all());
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
        $article->date = $request->date;

        try {
            $article->save();

        } catch (ValidationException $e) {
            $e->withMessages([
                "status" => "error",
                "message" => "Sem dados ineridos"
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Dado inserido"
        ]);
    }



    /**
     * BUSCAR POR ID
     */
    public function show(string $id)
    {
        $article = Articles::find($id);

        if (empty($article)) {
            return response()->json([
                "status" => "Erro",
                "message" => "Registro com id {$id} não existe"
            ]);
        }

        return new ArticlesResource(Articles::find($id));
    }



    /**
     * UPDATE
     */
    public function update(Request $request, string $id)
    {
        $article = Articles::find($id);
        if (empty($article)) {
            return response()->json([
                "status" => "Erro",
                "message" => "Registro com id {$id} não existe"
            ]);
        }

        $article->title = $request->title;
        $article->preview = $request->preview;
        $article->author = $request->author;
        $article->text = $request->text;
        $article->from_categories = $request->from_categories;
        $article->date = $request->date;

        try {
            $article->update();

        } catch (ValidationException $e) {
            $e->withMessages([
                "status" => "error",
                "message" => "Registro não atualizado"
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Registro atualizados"
        ]);

    }
    /**
     * DELETE
     */
    public function destroy(string $id)
    {
        try {
            $article = Articles::find($id);
            if (empty($article)) {
                return response()->json([
                    "status" => "Erro",
                    "message" => "Registro com id {$id} não existe"
                ]);
            }

            $article->delete();

            return response()->json([
                "status" => "Sucesso",
                "Message" => "Registro excluido"
            ]);

        } catch (ValidationException $e) {
            $e->withMessages([
                "status" => "Erro",
                "Message" => "O registro não foi excluido"
            ]);
        }
    }
}
