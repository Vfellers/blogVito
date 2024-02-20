<?php

use App\Http\Controllers\api\ArticlesController;
use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/auth", [AuthController::class, "auth"]);


//Grupo de API autenticado
Route::middleware("auth:sanctum")->group(function(){

    // //Listar todos
    // Route::get("/articles", [ArticlesController::class, "index"]);

    // //Listar um, pelo id
    // Route::get("/articles/{id}", [ArticlesController::class, "show"]);

    // //Adicionar novo
    // Route::post("/articles", [ArticlesController::class, "store"]);

    // //Update
    // Route::put("/articles/{id}", [ArticlesController::class, "update"]);

    // //DELETE
    // Route::delete("/articles/{id}", [ArticlesController::class, "destroy"]);


    //ROta de ressource, substituitodas as outras acima
    Route::apiResource("/articles", ArticlesController::class);
});