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

Route::group("api/front", function () {

	// 登录
	Route::post("loginByUnameAndPwd", "api/LoginController/loginByUnameAndPwd");

	// 注册
	Route::post("registerUser", "api/UserController/registerUser");

	// 获取分类或标签列表
	Route::get("findCategoryOrTagList", "api/CategoryTagController/findCategoryOrTagList");

	// 获取文章列表
	Route::get("findArticleList", "api/ArticleController/findArticleList");

	// 获取文章详情
	Route::get("getArticleDetail", "api/ArticleController/getArticleDetail");

});

// 管理端
Route::group("api/admin", function () {
	// 新增分类或标签
	Route::post("addCategoryOrTag", "api/CategoryTagController/addCategoryOrTag");

	// 更新分类或标签（删除）
	Route::post("updateCategoryOrTag", "api/CategoryTagController/updateCategoryOrTag");

	// 获取文章列表
	Route::get("findArticleListForAdmin", "api/ArticleController/findArticleListForAdmin");

	// 更新文章
	Route::post("updateArticle", "api/ArticleController/updateArticle");

	// 新增文章
	Route::post("addArticle", "api/ArticleController/addArticle");

	// 重置密码
	Route::post("resetPwd", "api/UserController/resetPwd");

	// 获取用户详情
	Route::get("getDetail", "api/UserController/getDetail");

	// 修改用户名密码
	Route::post("modifyPwd", "api/UserController/modifyPwd");

});