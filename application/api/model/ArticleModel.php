<?php
/**
 * @fileName ArticleModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 15:32
 * @description
 */


namespace app\api\model;


use think\Model;

class ArticleModel extends Model {

	protected $table = "article";

	protected $hidden = ["update_time", "status"];

	/**
	 * 新增文章
	 *
	 * @param $title
	 * @param $content
	 * @return array|bool|float|int|mixed|object|\stdClass|null
	 */
	public static function insertOne($title, $content) {
		$obj = new ArticleModel();
		$obj->title = $title;
		$obj->content = $content;
		$obj->save();
		return $obj->id;
	}

	/**
	 * 获取文章列表 客户端
	 * @param $keyword
	 * @param int $size
	 * @param int $page
	 * @return \think\Paginator
	 * @throws \think\exception\DbException
	 */
	public static function findAll($keyword, $page = 1, $size = 10) {
		return self::with(["categorys", "tags"])
			->where('title|content', 'like', "%$keyword%")
			->where("status", "=", 1)
			->paginate($size, false, ['page' => $page]);
	}


	/**
	 *  获取文章列表 管理端
	 * @param $keyword
	 * @param int $page
	 * @param int $size
	 * @return \think\Paginator
	 */
	public static function findAllForAdmin($keyword, $page = 1, $size = 10) {
		return self::with(["categorys", "tags"])
			->where('title|content', 'like', "%$keyword%")
			->paginate($size, false, ['page' => $page]);
	}


	/**
	 * 获取文章详情
	 *
	 * @param $id
	 * @return array|bool|false|\PDOStatement|string|Model|null
	 */
	public static function findOne($id) {
		return self::with(["categorys", "tags"])
			->find($id);
	}

	/**
	 * 更新&删除文章
	 *
	 * @param $id
	 * @param $title
	 * @param $content
	 * @param $status
	 * @return ArticleModel
	 */
	public static function updateOne($id, $title, $content, $status) {
		return self::where([
			"id" => $id
		])->update([
			"title" => $title,
			"content" => $content,
			"status" => $status
		]);
	}

	/**
	 * 获取文章所属的分类
	 *
	 */
	public function categorys() {
		return $this->belongsToMany(
			"CategoryTagModel", "article_category", "category_id", "article_id");
	}

	/**
	 * 获取文章所属的标签
	 */
	public function tags() {
		return $this->belongsToMany(
			"CategoryTagModel", "article_tag", "tag_id", "article_id");
	}

}