<?php
/**
 * @fileName ArticleController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 23:13
 * @description 文章管理
 */


namespace app\api\controller;

use app\api\model\ArticleCategoryModel;
use app\api\model\ArticleModel;
use app\api\model\ArticleTagModel;
use app\common\ResponseData;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\CommonUtil;
use app\validate\ArticleValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use think\Db;
use think\Request;

class ArticleController {

	/**
	 * 新增文章
	 * @param Request $request
	 * @return array
	 */
	public function addArticle(Request $request) {

		(new ArticleValidate())->goCheck();

		// token合法性
		CommonUtil::checkAuth();

		$title = $request->param("title");
		$content = $request->param("content");
		$categoryIds = $request->post("categoryIds/a");
		$tagIds = $request->param("tagIds/a");

		Db::transaction(function () use ($tagIds, $categoryIds, $content, $title) {
			$originArticle = ArticleModel::findOne($title);
			if (!empty($originArticle)) {
				throw new CustomException(ScopeEnum::ARTICLE_EXIST);
			}

			// 文章主表
			$articleId = ArticleModel::insertOne($title, $content);

			// 文章-分类
			foreach ($categoryIds as $categoryId) {
				ArticleCategoryModel::insertOne($articleId, $categoryId);
			}
			// 文章标签
			foreach ($tagIds as $tagId) {
				ArticleTagModel::insertOne($articleId, $tagId);
			}

		});
		return ResponseData::Success();

	}

	/**
	 * 获取文章列表
	 *
	 * @param Request $request
	 * @return array
	 */
	public function findArticleList(Request $request) {
		$keyword = $request->param("keyword");
		$page = $request->param("page");
		$size = $request->param("size");
		$data = ArticleModel::findAll($keyword, $page, $size);
		if (empty($data->items())) {
			throw new CustomException(ScopeEnum::LIST_EMPTY);
		}
		return ResponseData::Success($data);
	}


	/**
	 * 获取文章详情
	 *
	 * @param Request $request
	 * @return array
	 */
	public function getArticleDetail(Request $request) {
		(new IdValidate())->goCheck();
		$id = $request->param("id");
		$data = ArticleModel::findOne($id);
		if (empty($data)) {
			throw new CustomException(ScopeEnum::ARTICLE_EMPTY);
		}
		return ResponseData::Success($data);
	}

	public function updateArticle(Request $request) {

		(new IdValidate())->goCheck();

		(new StatusValidate())->goCheck();

		(new ArticleValidate())->goCheck();

		// token合法性
		CommonUtil::checkAuth();
		$id = $request->param("id");
		$title = $request->param("title");
		$content = $request->param("content");
		$status = $request->param("status");
		$categoryIds = $request->post("categoryIds/a");
		$tagIds = $request->param("tagIds/a");

		$originArticle = ArticleModel::get($id);
		if (empty($originArticle)) {
			throw new CustomException(ScopeEnum::ARTICLE_EMPTY);
		}

		Db::transaction(function () use ($tagIds, $categoryIds, $content, $title, $id, $status, $originArticle) {

			$originArticle = ArticleModel::where("title", $title)->find();

			if ($originArticle && $id != $originArticle->id) {
				throw new CustomException(ScopeEnum::ARTICLE_EXIST);
			}

			// 文章主表
			$articleId = ArticleModel::updateOne($id, $title, $content, $status);

			// 文章-分类
			ArticleCategoryModel::where("article_id", "=", $articleId)->delete();

			foreach ($categoryIds as $categoryId) {
				ArticleCategoryModel::insertOne($articleId, $categoryId);
			}

			// 文章标签
			ArticleTagModel::where("article_id", "=", $articleId)->delete();

			foreach ($tagIds as $tagId) {
				ArticleTagModel::insertOne($articleId, $tagId);
			}

		});
		return ResponseData::Success();

	}
}