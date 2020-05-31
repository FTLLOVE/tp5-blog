<?php
/**
 * @fileName UserModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 15:30
 * @description 用户模型
 */


namespace app\api\model;


use think\Model;

class UserModel extends Model
{

	protected $table = "user";

	public static function findOneByUnameAndPwd($username, $password)
	{
		$userModel = new UserModel();
		return $userModel->where("username", "=", $username)
			->where("password", "=", $password)
			->find();
	}

	public static function insertUser($username, $password)
	{
		self::create([
			"username" => $username,
			"password" => $password,
		]);

	}

}