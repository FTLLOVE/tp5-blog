<?php
/**
 * @fileName CategoryTagModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 01:13
 * @description
 */


namespace app\api\model;


use think\Model;

class CategoryTagModel extends Model {

	protected $table = "category_tag";

	protected $hidden = ["flag", "status", "create_time", "update_time", "pivot"];

	/**
	 * 根据名称和标识获取分类或标签
	 * @param $name
	 * @param $flag
	 * @return array|bool|false|\PDOStatement|string|Model|null
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function findOneByNameAndFlag($name, $flag) {
		$model = new CategoryTagModel();
		return $model->where("name", "=", $name)
			->where("flag", "=", $flag)
			->find();

	}

	/**
	 * 新增分类或标签
	 * @param $name
	 * @param $flag
	 */
	public static function insertOne($name, $flag) {
		CategoryTagModel::create([
			"name" => $name,
			"flag" => $flag
		]);
	}

	/**
	 * 更新分类或标签
	 * @param $id
	 * @param $name
	 * @param $flag
	 * @param $status
	 * @return CategoryTagModel
	 */
	public static function updateOne($id, $name, $flag, $status) {
		return self::where("id", $id)
			->update([
				"name" => $name,
				"flag" => $flag,
				"status" => $status
			]);
	}

	/**
	 * 获取 分类或标签列表
	 *
	 * @param $name
	 * @param $flag
	 * @param int $page
	 * @param int $size
	 * @return \think\Paginator
	 */
	public static function findAll($name, $flag, $page = 1, $size = 10) {
		return self::where("name", "like", "%$name%")
			->where("flag", $flag)
			->paginate($size, false, ['page' => $page]);
	}
}
