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

Route::get('/', function () {
    return view('login');
});
Route::get('/editdetail', function () {
    return redirect('/')->with('message', 'เส้นทางผิดพลาด');
});
Route::get('/editprofiles', function () {
    return redirect('/')->with('message', 'เส้นทางผิดพลาด');
});
Route::get('/profiles', function () {
    return redirect('/')->with('message', 'เส้นทางผิดพลาด');
});
Route::get('/detail', function () {
    return redirect('/')->with('message', 'เส้นทางผิดพลาด');
});


Route::get('/register',['as'=>'regist','uses'=>'HomeController@regist']);

Route::get('/backhome',['as'=>'backhome','uses'=>'HomeController@bkhome']);
Route::get('/backhome1',['as'=>'backhome1','uses'=>'HomeController@bkhome']);

Route::get('/backhome2',['as'=>'backhome2','uses'=>'HomeController@gohome']);



Route::get('/gohome',['as'=>'go_home','uses'=>'HomeController@gohome']);
Route::get('/gohome2',['as'=>'go_home2','uses'=>'HomeController@gohome']);
Route::get('/backtohome',['as'=>'backtohome','uses'=>'HomeController@gohome']);

Route::get('/addform',['as'=>'add_form','uses'=>'HomeController@addform']);
Route::resource('tree','HomeController');

Route::get('detail/{id}','HomeController@detail');
Route::get('editdetail/{id}','HomeController@editdetail');
Route::get('profiles/{id}','HomeController@profiles');
Route::get('editprofiles/{id}','HomeController@editprofiles');
Route::get('form/{lat}/{lng}',['as'=>'getlatlng','uses'=>'HomeController@getlatlng']);

Route::get('auth/login/facebook', 'HomeController@facebookAuthRedirect');
Route::get('auth/login/google', 'HomeController@googleAuthRedirect');
Route::post('auth/login/mytree','HomeController@emaillogin');
Route::get('validation','HomeController@validation');
Route::post('saveProfile','HomeController@saveProfile');
Route::post('createUser','HomeController@createUser');
Route::post('manageUser','HomeController@manageUser');
Route::get('approve','HomeController@approve');
Route::get('treelist','HomeController@treelist');
Route::post('treedel','HomeController@treedel');
Route::get('user/logout','HomeController@deleteSessionData');
Route::get('print/{id}','HomeController@printPaper');
Route::post('/sci_search',['as'=>'scisearch','uses'=>'HomeController@sci_search']);
Route::get('/page_reload',['as'=>'page_reload','uses'=>'HomeController@page_reload']);
