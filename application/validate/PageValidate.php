<?php
/**
 * @fileName PageValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 22:35
 * @description
 */


namespace app\validate;


class PageValidate extends BaseValidate
{

	protected $rule = [
		["page", "require|number", "页码不能为空|页码必须是数字"],
		["size", "require|number", "数量不能为空|数量必须是数字"]
	];
}