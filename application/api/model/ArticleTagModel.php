<?php
/**
 * @fileName ArticleTagModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/29 00:20
 * @description
 */


namespace app\api\model;


use think\Model;

class ArticleTagModel extends Model {
	protected $table = "article_tag";
	protected $autoWriteTimestamp = false;

	/**
	 * 新增文章-标签
	 *
	 * @param $articleId
	 * @param $tagId
	 */
	public static function insertOne($articleId, $tagId) {
		self::create([
			"article_id" => $articleId,
			"tag_id" => $tagId
		]);
	}

	/**
	 * 删除文章-标签
	 *
	 * @param $articleId
	 * @param $tagId
	 */
	public static function deleteOne($articleId, $tagId) {
		self::destroy([
			"article_id" => $articleId,
		]);
	}

}