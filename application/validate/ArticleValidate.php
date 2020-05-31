<?php
/**
 * @fileName ArticleValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 00:46
 * @description
 */


namespace app\validate;


class ArticleValidate extends BaseValidate
{
	protected $rule = [
		["title", "require", "标题不能为空"],
		["content", "require", "内容不能为空"],
		["categoryIds", "require|array|min:1", "分类不能为空|分类必须是数组|分类至少有一个"],
		["tagIds", "require|array|min:1", "标签不能为空|标签必须是数组|标签至少有一个"],
	];
}