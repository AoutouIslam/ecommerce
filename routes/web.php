<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchArticleController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\Mail\MailController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function()  {
    return redirect('home');
})->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard',[DashboardController::class,'index'])
->name('dashboard')->middleware('auth');

Route::post('/logout',[LogoutController::class,'store'])->name('logout');
//Route::post('/login',[LoginController::class,'store']);


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);


Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/posts',[PostController::class,'index'])->name('posts');
Route::post('/posts',[PostController::class,'store']);
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');


Route::post('/posts/{post}/likes',[PostLikeController::class,'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes',[PostLikeController::class,'destroy'])->name('posts.likes');

Route::get('/article',[ArticleController::class,'index'])->name('article');
Route::get('/search',[ArticleController::class,'searchProduct'])->name('article.search');
Route::post('/search',[ArticleController::class,'search']);



Route::get('/article/searchArticle',[SearchArticleController::class,'index'])->name('search');
Route::get('/search',[SearchArticleController::class,'searchProduct'])->name('article.search');



// add article
Route::get('/admin/addarticle',[AddArticleController::class,'index'])->name('addarticle');
Route::post('/admin/addarticle',[AddArticleController::class,'store']);



Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/email/verify',  [VerificationController::class,'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',  [VerificationController::class,'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', [VerificationController::class,'resend'])->name('verification.resend');

Auth::routes();
