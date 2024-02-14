<?php

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

