<?php
/**
 * @fileName UserValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 16:29
 * @description
 */


namespace app\validate;


class UserValidate extends BaseValidate
{
	protected $rule = [
		["username", "require", "用户名不能为空"],
		["password", "require", "密码不能为空"],
	];
}