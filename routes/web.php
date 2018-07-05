<?php

// 首页路由
Route::get('/', 'PagesController@root')->name('root');

Auth::routes();

// 资源路由
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
