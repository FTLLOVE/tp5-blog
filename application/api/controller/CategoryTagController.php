<?php
/**
 * @fileName CategoryTagController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/28 00:53
 * @description 分类&标签管理
 */


namespace app\api\controller;


use app\api\model\CategoryTagModel;
use app\api\model\UserModel;
use app\common\ResponseData;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\CommonUtil;
use app\validate\CategoryAndTagValidate;
use app\validate\FlagValidate;
use app\validate\IdValidate;
use app\validate\PageValidate;
use app\validate\StatusValidate;
use think\Request;

class CategoryTagController
{

	/**
	 * 新增分类或标签
	 *
	 * @param Request $request
	 * @return array
	 */
	public function addCategoryOrTag(Request $request)
	{
		(new CategoryAndTagValidate())->goCheck();

		$tokenData = CommonUtil::checkAuth();

		$userId = $tokenData->id;

		$user = UserModel::get($userId);

		// 用户是否存在
		if (empty($user)) {
			throw new CustomException(ScopeEnum::USER_EMPTY);
		}

		// 判断分类或者标签是否存在
		$name = $request->param("name");
		$flag = $request->param("flag");
		$CategoryTag = CategoryTagModel::findOneByNameAndFlag($name, $flag);
		if (!empty($CategoryTag) && ($CategoryTag->flag == 1)) {
			throw new CustomException(ScopeEnum::CATEGORY_EXIST);
		}

		if (!empty($CategoryTag) && ($CategoryTag->flag == 2)) {
			throw new CustomException(ScopeEnum::TAG_EXIST);
		}
		// 新增
		CategoryTagModel::insertOne($name, $flag);
		return ResponseData::Success();
	}

	/**
	 * 更新分类或标签(含删除)
	 *
	 * @param Request $request
	 * @return array
	 */
	public function updateCategoryOrTag(Request $request)
	{
		// id验证器
		(new IdValidate())->goCheck();

		// 具体字段验证器
		(new CategoryAndTagValidate())->goCheck();

		// 状态验证器
		(new StatusValidate())->goCheck();

		// token合法性
		CommonUtil::checkAuth();

		$name = $request->param("name");
		$flag = $request->param("flag");
		$id = $request->param("id");
		$status = $request->param("status");

		$originObj = CategoryTagModel::get($id);
		if (empty($originObj) && $flag == 1) {
			throw new CustomException(ScopeEnum::CATEGORY_EMPTY);
		}

		if (empty($originObj) && $flag == 2) {
			throw new CustomException(ScopeEnum::TAG_EMPTY);
		}

		// 唯一性校验
		$originObj = CategoryTagModel::findOneByNameAndFlag($name, $flag);
		if (!empty($originObj) && ($originObj->id != $id)) {
			throw new CustomException(ScopeEnum::TAG_EXIST);
		}

		//TODO 如果文章中有标签或分类存在的话，需处理

		// 更新
		CategoryTagModel::updateOne($id, $name, $flag, $status);

		return ResponseData::Success();
	}


	/**
	 * 获取分类或标签列表
	 *
	 * @param Request $request
	 * @return array
	 */
	public function findCategoryOrTagList(Request $request)
	{
		(new FlagValidate())->goCheck();

		(new PageValidate())->goCheck();

		$page = $request->param("page");
		$size = $request->param("size");
		$name = $request->param("name");
		$flag = $request->param("flag");
		$list = CategoryTagModel::findAll($name, $flag, $page, $size);
		return ResponseData::Success($list);
	}

}