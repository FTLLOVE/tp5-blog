<?php
/**
 * @fileName ArticleCategoryModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 15:32
 * @description
 */


namespace app\api\model;

use think\Model;

class ArticleCategoryModel extends Model
{
	protected $table = "article_category";

	protected $autoWriteTimestamp = false;

	/**
	 * 新增文章-分类
	 *
	 * @param $articleId
	 * @param $categoryId
	 */
	public static function insertOne($articleId, $categoryId)
	{
		self::create([
			"article_id" => $articleId,
			"category_id" => $categoryId
		]);
	}

	/**
	 * 删除文章-分类
	 *
	 * @param $articleId
	 */
	public static function deleteOne($articleId)
	{
		self::destroy([
			"article_id" => $articleId
		]);
	}
}