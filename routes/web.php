<?php
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

Route::get('/', 'MainStageController@index');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mainstage','MainStageController@index');

Route::get('/dressingRoom','DrController@index');


Route::get('/add1/{id}','VideoController@addPlayCount');

Route::get('/inHouse','InClubPerformerController@inHouse');

Route::get('/allGirls','InClubPerformerController@allGirls');

Route::resource('/videos','VideoController');

Route::post('/videoPurchase','VideoPurchaseController@buyVideo');

Route::resource('/profile','PerformerProfileController');


Route::get('/dj','MainStageController@dj');

Route::resource('/inclub', 'InClubPerformerController');


Route::resource('/MsChat','MsChatController');

//vue js chat
Route::get('/chat', 'ChatController@chat');

Route::post('/send', 'ChatController@send');

Route::get('check', function (){
    return session('chat');
});



//Route::get('/inclub', 'InClubPerformerController@index');

Route::get('/friend','FriendshipController@beFriend' );

Route::get('/poolsearch/{name}', 'InClubPerformerController@search');

Route::get('/allGirlsSearch/{name}', 'InClubPerformerController@allGirlsSearch');


Route::post('/MsChatPost/{id}', ['as'=>"mschat.post", "uses"=>'MsChatController@post']);
//Route::post('/mschatpost/{id}', 'MsChatController@store');


//Route::get('/chat', 'ChatsController@index');
//Route::get('messages', 'ChatsController@fetchMessages');
//Route::post('messages', 'ChatsController@sendMessage');
