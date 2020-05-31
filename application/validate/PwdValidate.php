<?php
/**
 * @fileName PwdValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 23:22
 * @description
 */


namespace app\validate;


class PwdValidate extends BaseValidate
{

	protected $rule = [
		["oldPwd", "require", "旧密码不能为空"],
		["newPwd", "require", "新密码不能为空"],
		["confirmPwd", "require|confirm:newPwd", "确认密码不能为空|新密码和确定密码不匹配"],

	];

}