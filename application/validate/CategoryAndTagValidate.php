<?php
/**
 * @fileName CategoryAndTagValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 00:49
 * @description
 */


namespace app\validate;


class CategoryAndTagValidate extends BaseValidate
{
	protected $rule = [
		["name", "require", "名称不能为空"],
		["flag", "require|number|in:1,2", "标识不能为空|标识只能是数字|标识只能是1或2"]
	];
}