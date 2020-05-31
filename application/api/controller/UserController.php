<?php
/**
 * @fileName UserController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 22:35
 * @description 用户管理
 */


namespace app\api\controller;


use app\api\model\UserModel;
use app\common\ResponseData;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\CommonUtil;
use app\validate\PwdValidate;
use app\validate\UserValidate;
use think\Request;

class UserController
{

	/**
	 * 注册用户
	 *
	 * @param Request $request
	 * @return array
	 * @throws CustomException
	 */
	public function registerUser(Request $request)
	{

		(new UserValidate())->goCheck();
		$username = $request->param("username");
		$password = $request->param("password");

		$user = UserModel::getByUsername($username);
		if (!empty($user)) {
			throw new CustomException(ScopeEnum::USER_EXIST);
		}

		$newPwd = password_hash($password, PASSWORD_DEFAULT);

		UserModel::insertUser($username, $newPwd);
		return ResponseData::Success();
	}

	/**
	 * 获取用户详情
	 *
	 * @return array
	 * @throws CustomException
	 */
	public function getDetail()
	{

		$tokenData = CommonUtil::checkAuth();
		$data = UserModel::get($tokenData->id);
		return ResponseData::Success($data->getData());
	}

	/**
	 * 修改密码
	 *
	 * @param Request $request
	 * @return array
	 * @throws CustomException
	 * @throws \think\exception\DbException
	 */
	public function modifyPwd(Request $request)
	{
		(new PwdValidate())->goCheck();

		$tokenData = CommonUtil::checkAuth();

		$user = UserModel::get($tokenData->id);

		// 用户是否存在
		if (empty($user)) {
			throw new CustomException(ScopeEnum::USER_EMPTY);
		}

		// 老密码是否填写错误
		$vertifyPwd = password_verify($request->param("oldPwd"), $user->password);

		if (!$vertifyPwd) {
			throw new CustomException(ScopeEnum::PASSWORD_ERROR);
		}

		// 更新密码
		$user->password = password_hash($request->param('newPwd'), PASSWORD_DEFAULT);
		$user->save();
		return ResponseData::Success();
	}

	/**
	 * 重置密码
	 *
	 * @return array
	 * @throws CustomException
	 * @throws \think\exception\DbException
	 */
	public function resetPwd()
	{

		$tokenData = CommonUtil::checkAuth();

		$user = UserModel::get($tokenData->id);

		// 用户是否存在
		if (empty($user)) {
			throw new CustomException(ScopeEnum::USER_EMPTY);
		}

		$user->password = password_hash(ScopeEnum::DEFAULT_PWD, PASSWORD_DEFAULT);
		$user->save();
		return ResponseData::Success();
	}

}