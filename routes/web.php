<?php

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
    return redirect()->route("login");
});

Auth::routes(["reset"=>false]);
Route::post('/controlUsername',"Auth\RegisterController@controlUsername")->name('controlUsername');

Route::group(['middleware'=>['auth']], function(){
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/searchContent', 'SearchContentController@index')->name('searchContent');
Route::get('/searchPeople', 'SearchPeopleController@index')->name('searchPeople');
Route::get('/restituisciUtenti',"SearchPeopleController@restituisciUtenti")->name('restituisciUtenti');
Route::get('/FollowPeople',"SearchPeopleController@FollowPeople")->name('FollowPeople');
Route::get('/DisfollowPeople',"SearchPeopleController@DisfollowPeople")->name('DisfollowPeople');
Route::get('/SeeUser',"SearchPeopleController@SeeUser")->name('SeeUser');
Route::get('/DoSearchPeople',"SearchPeopleController@DoSearchPeople")->name('DoSearchPeople');
Route::post('/DoSearchContent',"SearchContentController@DoSearchContent")->name('DoSearchContent');
Route::get('/SharePost',"SearchContentController@SharePost")->name('SharePost');
Route::get('/UtentiSeguiti', 'HomeController@UtentiSeguiti')->name('UtentiSeguiti');
Route::get('/TogliLike', 'HomeController@TogliLike')->name('TogliLike');
Route::get('/AggiungiLike', 'HomeController@AggiungiLike')->name('AggiungiLike');
Route::get('/UtentiLikes', 'HomeController@UtentiLikes')->name('UtentiLikes');
Route::get('/seguiti', 'HomeController@seguiti')->name('seguiti');
Route::get('/seguaci', 'HomeController@seguaci')->name('seguaci');
Route::get('/UtenteInfo', 'HomeController@UtenteInfo')->name('UtenteInfo');
});