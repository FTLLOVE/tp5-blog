<?php
/**
 * @fileName CommonUtil.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/5/27 23:15
 * @description
 */


namespace app\util;


use app\enum\ScopeEnum;
use app\exception\CustomException;

class CommonUtil {

	public static function checkAuth() {

		$token = $_REQUEST['token'];
		if (empty($token)) {
			throw new CustomException(ScopeEnum::AUTHORIZED_ERROR);
		}
		$jwtToken = new Token();
		$checkToken = $jwtToken->checkToken($token);
		if (empty($checkToken)) {
			throw new CustomException(ScopeEnum::AUTHORIZED_ERROR);
		}
		return $checkToken['data']['data'][0];
	}
}