<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Route;

// 登录
Route::post("api/loginByUnameAndPwd", "api/LoginController/loginByUnameAndPwd");

// 注册
Route::post("api/registerUser", "api/UserController/registerUser");

// 获取用户详情
Route::get("api/getDetail", "api/UserController/getDetail");

// 修改用户名密码
Route::post("api/modifyPwd", "api/UserController/modifyPwd");

// 重置密码
Route::post("api/resetPwd", "api/UserController/resetPwd");

// 新增文章
Route::post("api/addArticle", "api/ArticleController/addArticle");

// 获取文章列表
Route::get("api/findArticleList", "api/ArticleController/findArticleList");

// 获取文章详情
Route::get("api/getArticleDetail", "api/ArticleController/getArticleDetail");

// 更新文章
Route::post("api/updateArticle", "api/ArticleController/updateArticle");

// 新增分类或标签
Route::post("api/addCategoryOrTag", "api/CategoryTagController/addCategoryOrTag");

// 更新分类或标签
Route::post("api/updateCategoryOrTag", "api/CategoryTagController/updateCategoryOrTag");

// 获取分类或标签列表
Route::get("api/findCategoryOrTagList", "api/CategoryTagController/findCategoryOrTagList");


