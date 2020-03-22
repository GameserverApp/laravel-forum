<?php

// Categories
$r->group(['prefix' => 'categories', 'as' => 'category.'], function ($r)
{
    $r->get('/', ['as' => 'index', 'uses' => 'CategoryController@index']);
    $r->post('/', ['as' => 'store', 'uses' => 'CategoryController@store']);
    $r->get('{id}', ['as' => 'fetch', 'uses' => 'CategoryController@fetch']);
    $r->delete('{id}', ['as' => 'delete', 'uses' => 'CategoryController@destroy']);
    $r->patch('{id}', ['as' => 'update', 'uses' => 'CategoryController@update']);
});

// Threads
$r->group(['prefix' => 'threads', 'as' => 'thread.'], function ($r)
{
    $r->get('/', ['as' => 'index', 'uses' => 'ThreadController@index']);
    $r->get('new', ['as' => 'new.index', 'uses' => 'ThreadController@indexNew']);
    $r->patch('new', ['as' => 'new.mark-read', 'uses' => 'ThreadController@markNewAsRead']);
    $r->post('/', ['as' => 'store', 'uses' => 'ThreadController@store']);
    $r->get('{id}', ['as' => 'fetch', 'uses' => 'ThreadController@fetch']);
    $r->delete('{id}', ['as' => 'delete', 'uses' => 'ThreadController@destroy']);
    $r->patch('{id}', ['as' => 'update', 'uses' => 'ThreadController@update']);
});

// Posts
$r->group(['prefix' => 'posts', 'as' => 'post.'], function ($r)
{
    $r->get('/', ['as' => 'index', 'uses' => 'PostController@index']);
    $r->post('/', ['as' => 'store', 'uses' => 'PostController@store']);
    $r->get('{id}', ['as' => 'fetch', 'uses' => 'PostController@fetch']);
    $r->patch('{id}', ['as' => 'update', 'uses' => 'PostController@update']);
    $r->delete('{id}', ['as' => 'delete', 'uses' => 'PostController@destroy']);
    $r->post('{id}/restore', ['as' => 'restore', 'uses' => 'PostController@restore']);
});

// Bulk actions
$r->group(['prefix' => 'bulk', 'as' => 'bulk.'], function ($r)
{
    // Categories
    $r->group(['prefix' => 'categories', 'as' => 'category.'], function ($r)
    {
        $r->post('manage', ['as' => 'manage', 'uses' => 'CategoryController@bulkManage']);
    });

    // Threads
    $r->group(['prefix' => 'threads', 'as' => 'thread.'], function ($r)
    {
        $r->delete('/', ['as' => 'delete', 'uses' => 'ThreadController@bulkDestroy']);
        $r->patch('restore', ['as' => 'restore', 'uses' => 'ThreadController@bulkRestore']);
        $r->patch('move', ['as' => 'move', 'uses' => 'ThreadController@bulkMove']);
        $r->patch('lock', ['as' => 'lock', 'uses' => 'ThreadController@bulkLock']);
        $r->patch('unlock', ['as' => 'unlock', 'uses' => 'ThreadController@bulkUnlock']);
        $r->patch('pin', ['as' => 'pin', 'uses' => 'ThreadController@bulkPin']);
        $r->patch('unpin', ['as' => 'unpin', 'uses' => 'ThreadController@bulkUnpin']);
    });

    // Posts
    $r->group(['prefix' => 'posts', 'as' => 'post.'], function ($r)
    {
        $r->patch('/', ['as' => 'update', 'uses' => 'PostController@bulkUpdate']);
        $r->delete('/', ['as' => 'delete', 'uses' => 'PostController@bulkDestroy']);
        $r->patch('restore', ['as' => 'restore', 'uses' => 'PostController@bulkRestore']);
    });
});
