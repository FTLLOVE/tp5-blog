<?php
/**
 * @fileName ScopeEnum.php
 * @author sprouts
 * @email 1139556759@qq.com
 * @date 2020/5/20 22:13
 * @description
 */


namespace app\enum;


class ScopeEnum {
	const DEFAULT_PWD = "admin";
	const USER_EMPTY = "用户不存在";
	const USER_EXIST = "用户已存在";
	const PASSWORD_ERROR = "密码错误";
	const AUTHORIZED_ERROR = "认证未通过";
	const CATEGORY_EXIST = "分类已存在";
	const TAG_EXIST = "标签已存在";
	const CATEGORY_EMPTY = "分类不存在";
	const TAG_EMPTY = "标签不存在";
	const ARTICLE_EXIST = "文章标题已存在";
	const ARTICLE_EMPTY = "文章不存在";
	const LIST_EMPTY = "列表无数据";

}