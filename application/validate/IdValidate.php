<?php
/**
 * @fileName IdValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 17:38
 * @description
 */


namespace app\validate;


class IdValidate extends BaseValidate
{

	protected $rule = [
		["id", "require|number", "id不能为空|id必须是数字"]
	];
}