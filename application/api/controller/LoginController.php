<?php
/**
 * @fileName LoginController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 16:22
 * @description 登录管理
 */


namespace app\api\controller;


use app\api\model\UserModel;
use app\common\ResponseData;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\Token;
use app\validate\UserValidate;
use think\Cache;
use think\Request;

class LoginController
{

	/**
	 * 用户名密码登录
	 *
	 * @param Request $request
	 * @return array
	 * @throws CustomException
	 */
	public function loginByUnameAndPwd(Request $request)
	{
		(new UserValidate())->goCheck();

		$username = $request->param("username");
		$password = $request->param("password");

		// 用户名查询用户
		$user = UserModel::getByUsername($username);
		if (empty($user)) {
			throw new CustomException(ScopeEnum::USER_EMPTY);
		}

		// 密码校验
		$vertifyPwd = password_verify($password, $user->getData("password"));

		if (!$vertifyPwd) {
			throw new CustomException(ScopeEnum::PASSWORD_ERROR);
		}

		// 构建token存储数据
		$data = array([
			"id" => $user->getData("id"),
			"username" => $user->getData("username")
		]);

		$jwtToken = new Token();
		$token = $jwtToken->createToken($data)['token'];
		Cache::store("redis")->set($user->getData("id"), $token);
		return ResponseData::Success($token);
	}

}