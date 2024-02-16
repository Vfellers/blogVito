<?php

use App\Http\Controllers\admin\ArticlesAdmController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, "index"]);      //homecontroller é o controller que criei, index é o metodo que vou criar na controller


Route::get('/artigos', [ArticlesController::class, "index"]);                   
Route::get('/artigo/{id}/{permalink}', [ArticlesController::class, "detail"]);      //article.blade.php




//=========================================================================================================================================================================
//                                                                         PAINEL DE ADMINISTRAÇÃO
//=========================================================================================================================================================================

Route::view("/admin/login", "admin.login.form")->name("login.form");

Route::post("/admin/auth", [LoginController::class, "auth"])->name("login.auth");

// Route::get("/admin/logout", [LoginController::class, "logout"]);

// Route::get("/admin", [DashboardController::class, "index"]);
// Route::get("/admin", [DashboardController::class, "index"])->middleware("validalogin");     // ValidaLogin vem do kernel e do middleware

//Grupo de middleware pra sempre usar o login nessas paginas
Route::middleware("validalogin")->group(function(){

    Route::get("/admin", [DashboardController::class, "index"]);                //Login de cima eu trouxe pra baixo pra por no grupode middleware, o mesmo pro logout

    Route::resource("/admin/artigos", ArticlesAdmController::class);

    Route::get("/admin/logout", [LoginController::class, "logout"]);
});
