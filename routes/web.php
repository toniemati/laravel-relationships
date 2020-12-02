<?php

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    App::setlocale('es');

    return view('welcome');
});

Route::get('/oto', function () {
    $user = User::factory()->create();

    $randomPhone = rand(100, 999) . '-' . rand(100, 999) . '-' . rand(100, 999);

    $user->phone()->create([
        'phone' => $randomPhone
    ]);
});


Route::get('/otm', function () {

    $user = User::factory()->create();

    $user->posts()->create([
        'title' => 'Title here',
        'body' => 'Body here',
    ]);

    $user->posts->first()->title = 'New title';
    $user->posts->first()->body = 'New better body';

    $user->push();

    return $user->posts;
});

Route::get('/mtm', function () {
    //* sync()
    //* syncWithoutDetaching()

    $user = User::first();

    // $user->roles()->sync([
    //     1 => [
    //         'name' => 'Victor'
    //     ]
    // ]);

    dd($user->roles->first()->pivot->name);
});
