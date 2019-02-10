<?php
/*ici tous les routes des pages concernent tous le monde 
                   ****** for All ******
    ****************************************************/
Route::get('/','PagesController@home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// tous les posts and categories 
Route::get('categorie','PagesController@categories_for_all');
Route::get('post','PagesController@posts_for_all');
// post ou categorie li 3ndo l id 
Route::get('categorie/{id}','PagesController@categorie_for_all');
Route::get('post/{id}','PagesController@post_for_all');

/******************************************** 
                **** user ******
    ****************************************************/
Route::group(['middleware'=>'roles','roles' => ['super_admin','admin','editor','simple_user']],function(){

});


/********************************************************
                  ****** editor ******
    ****************************************************/
Route::group(['middleware'=>'roles','roles' => ['super_admin','admin','editor']],function(){
Route::resource('posts','PostController');
Route::resource('subposts','SubpostController');
});
/*
Route::get('subposts/{id}','SubpostController@index');
Route::get('subposts/create','SubpostController@create');
Route::post('subposts','SubpostController@store');
Route::get('subposts/{subpost}/edit','SubpostController@edit');
Route::put('subposts/{subpost}','SubpostController@update');
Route::delete('subposts/{subpost}','SubpostController@destroy');
*/


/*********************************************************
                  ***** Admin ******
    ****************************************************/
Route::group(['middleware'=>'roles','roles' => ['super_admin','admin']],function(){
Route::get('registerfromadmins','RegistrationController@adminindex');
Route::post('registerfromadmins','RegistrationController@adminstore');
});
/**************************************************** 
               ***** super admin ******
    ****************************************************/
Route::group(['middleware'=>'roles','roles' => ['super_admin']],function(){
Route::resource('admincategories','CategorieController');
Route::resource('registrations','RegistrationController');
});

