<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
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

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','can:admin'])->group(function(){ //管理者のみ閲覧可能にする
    Route::get('/profile/index',[ProfileController::class,'index'])->name('profile.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('post/mypost',[PostController::class,'mypost'])->name('post.mypost'); //自分の投稿のみ表示
Route::get('post/mycomment',[PostController::class,'mycomment'])->name('post.mycomment'); //自分のコメントのみ表示
// Route::resource('post',PostController::class); //このコード一本でCRUD（Create, Read, Update, Delete）操作を処理できる
Route::get('post/create',[PostController::class,'create'])->name('post.create');
Route::post('post',[PostController::class,'store'])->name('post.store');
Route::get('post',[PostController::class,'index'])->name('post.index');
Route::get('post/{post}',[PostController::class,'show'])->name('post.show');
Route::get('post/{post}/edit',[PostController::class,'edit'])->name('post.edit'); //PostController.phpのeditメソッドに処理を受け渡す
Route::put('/post/{post}',[PostController::class,'update'])->name('post.update');
Route::delete('/post/{post}',[PostController::class,'destroy'])->name('post.destroy');
//コメント機能
Route::post('post/comment/store',[CommentController::class,'store'])->name('comment.store');
//お問い合わせ機能
// Route::get('contact/create',[ContactController::class,'create'])->name('contact.create'); //お問い合わせ表示
// Route::post('contact/store',[ContactController::class,'store'])->name('contact.store');  //お問い合わせ保存

//お問い合わせ機能(グループ化の実装)
Route::controller(ContactController::class)->group(function()
{
 Route::get('contact/create','create')->name('contact.create')->middleware('guest');
 Route::post('contact/store','store')->name('contact.store');
});



