<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',"LoginController@index");

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::any('Login/index',"LoginController@index");//登录
    Route::any('Index/index',"IndexController@index");//首页
    Route::any('Index/loginout',"IndexController@loginout");//退出
    Route::any('Index/head', 'IndexController@head');//头部
    Route::any('Index/left', 'IndexController@left');//左侧
    Route::any('Index/right', 'IndexController@right');//右侧

    Route::any('Firm/liebiao', 'FirmController@liebiao');//企业
    Route::any('Firm/rz', 'FirmController@rz');//认证
    Route::any('Firm/fj', 'FirmController@fj');//否决
    Route::any('Firm/search', 'FirmController@search');//搜索
    Route::any('Firm/wsh', 'FirmController@wsh');//未审核
    Route::any('Firm/yrz', 'FirmController@yrz');//已认证
    Route::any('Firm/wtg', 'FirmController@wtg');//未通过
    Route::any('Firm/show', 'FirmController@show');//职位列表
    Route::any('Firm/recruit', 'FirmController@recruit');//职位列表搜索
    Route::any('Firm/ss', 'FirmController@ss');//职位列表搜索
	Route::any('Firm/firm', 'FirmController@firm');//职位列表搜索


    Route::any('Advert/advert', 'AdvertController@advert');//广告
    Route::any('Advert/advertadd', 'AdvertController@advertadd');//广告添加
    Route::any('Advert/firm_name', 'AdvertController@firm_name');//广告添加入库 ajax验证公司是否存在
    Route::any('Advert/add', 'AdvertController@add');//广告添加入库
    Route::any('Advert/delete', 'AdvertController@delete');//广告删除
    Route::any('Advert/update', 'AdvertController@update');//广告修改
    Route::any('Advert/up_update', 'AdvertController@up_update');//广告修改列表
    Route::any('Advert/adv_show', 'AdvertController@adv_show');//广告修改显示状态


    Route::any('Preson/preson', 'PresonController@preson');//个人信息
    Route::any('Preson/resume_list', 'PresonController@resume_list');//简历列表
    Route::any('Preson/see', 'PresonController@see');//个人信息查看
    Route::any('Type/type', 'TypeController@type');//职位分类
    Route::any('Type/lists', 'TypeController@lists');//职位分类列表
    Route::any('Type/search', 'TypeController@search');//职位分类搜索

    Route::any('Article/article', 'ArticleController@article');//文章管理
    Route::any('Article/delt', 'ArticleController@delt');//文章删除
    Route::any('Article/add', 'ArticleController@add');//文章添加
    Route::any('Article/add_list', 'ArticleController@add_list');//文章添加

    Route::any('Sort/sort', 'SortController@sort');//文章分类管理
    Route::any('Sort/delt', 'SortController@delt');//文章分类删除
    Route::any('Sort/add', 'SortController@add');//文章分类添加
    Route::any('Sort/up', 'SortController@up');//文章分类添加
    Route::any('Sort/add_list', 'SortController@add_list');//文章分类显示页面

    Route::any('Search/search', 'SearchController@search');//热词管理
    Route::any('Search/delete', 'SearchController@delete');//热词管理  删除
    Route::any('Search/update', 'SearchController@update');//热词管理  修改
    Route::any('Search/e_update', 'SearchController@e_update');//热词管理  执行修改
    Route::any('Search/s_search', 'SearchController@s_search');//热词管理  执行搜索

    Route::any('User/user', 'UserController@user');//管理员列表

    Route::any('System/changepwd', 'SystemController@changepwd');//系统管理
    Route::any('System/getpwd', 'SystemController@getpwd');//获取密码
    Route::any('System/pwd', 'SystemController@pwd');//修改密码
});


