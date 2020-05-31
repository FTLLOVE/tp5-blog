<?php
/**
 * @fileName FlagValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 22:48
 * @description
 */


namespace app\validate;


class FlagValidate extends BaseValidate
{

	protected $rule = [
		["flag", "require|number|in:1,2", "标识不能为空|标识只能是数字|标识只能是1或2"]
	];

}