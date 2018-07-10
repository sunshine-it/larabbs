<?php

// 首页路由
Route::get('/', 'PagesController@root')->name('root');

Auth::routes();

// 资源路由
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
// 话题骨架资源路由
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

// 分类下的话题列表资源路由
Route::resource('categories', 'CategoriesController', ['only'=>['show']]);

// 上传图片路由
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
// 回复列表路由
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
// 发表表回复路由
Route::resource('replies', 'RepliesController', ['only' => [ 'store', 'destroy']]);
// 消息通知路由
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);