<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserProfilecontroller;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



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

require __DIR__ . '/auth.php';

Route::get('/', [QuestionsController::class, 'index']);

Route::get('/dashboard', function () {
     return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// 'auth', 'verified', 'password.confirm'
Route::group([
     //استخدام افتراضي
     //'middleware' => ['locale'],
     //لاستخدام مكتبة جاهزة لللغات  mcamara
     'prefix' => LaravelLocalization::setLocale(),
     'middleware' => ['localizationRedirect', 'localeViewPath'],
     //
], function () {


     Route::get('/', [QuestionsController::class, 'index']);




     Route::prefix('tags')
          ->as('tags.')
          ->middleware(['user.type:admin, super-admin'])
          ->group(function () {
               Route::get('/', [TagsController::class, 'index'])
                    ->name('index');
               ///اضافة عناصر
               Route::get('/create', [TagsController::class, 'create'])
                    ->name('create');
               Route::post('/', [TagsController::class, 'store'])
                    ->name('store');
               //تعديل عنصر ما
               Route::get('/{id}/edit', [TagsController::class, 'edit'])
                    ->name('edit');
               Route::put('/{id}', [TagsController::class, 'update'])
                    ->name('update');
               //حذف عنصر ما
               Route::delete('/{id}', [TagsController::class, 'destroy'])
                    ->name('destroy');
          });

     //******************** */
     Route::resource('roles', RolesController::class)
          ->middleware(['auth', 'user.type:admin, super-admin']);


     //******************** */
     Route::resource('questions', QuestionsController::class);

     // user profile photo
     Route::group([
          'middleware' => 'auth',
     ], function () {

          Route::get('notifications', [NotificationsController::class, 'index'])
               ->name('notifications');
          Route::get('profile', [UserProfilecontroller::class, 'edit'])
               ->name('profile');
          Route::put('profile', [UserProfilecontroller::class, 'update']);
          //**************
          Route::resource('tags', TagsController::class)
               ->middleware(['auth', 'user.type:admin, super-admin']);
          //************* */
          Route::post('/answers', [AnswersController::class, 'store'])
               ->name('answers.store');
          Route::put('answers/{id}/best', [AnswersController::class, 'best'])
               ->name('answers.best');
     });
});
