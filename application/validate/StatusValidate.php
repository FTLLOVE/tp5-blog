<?php
/**
 * @fileName StatusValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 22:19
 * @description
 */


namespace app\validate;


class StatusValidate extends BaseValidate {

	protected $rule = [
		["status", "require|number|in:0,1", "状态不能为空|状态只能为数字|状态只能是0或1"]
	];
}