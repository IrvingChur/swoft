<?php

namespace App\Models\Logic;

use App\Models\Dao\UserDao;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use App\Common\Models\Common;
use Swoft\Db\Db;

/**
 * Class RegisterLogic
 * @package App\Models\Logic
 */
class RegisterLogic
{
    public $message = '';

    /**
     * 注册处理
     * @param string $nickname
     * @param string $account
     * @param string $password
     * @param null|string $wechatAccount
     * @param null|string $email
     * @param null|string $mobile
     * @param null|string $photoUrl
     * @return bool
     */
    public function register(string $nickname, string $account, string $password, ?string $wechatAccount, ?string $email, ?string $mobile, ?string $photoUrl): bool
    {
        $timestamp = App::getBean('Common')->getTimestamp();

        Db::beginTransaction();
        try {
            // 解开数据 table:user
            $user = [
                'nickname' => $nickname,
                'photoUrl' => $photoUrl,
                'account' => $account,
                'password' => md5($password),
                'status' => UserDao::USER_STATUS_NORMAL,
                'createdTime' => $timestamp,
                'updateTime' => $timestamp,
            ];

            $lastInsertId = App::getBean('NewModels')->getModelsObject('Data', 'RegisterData')->insertTableUser($user);

            $userDetails = [
                'userId' => $lastInsertId,
                'wechatAccount' => $wechatAccount,
                'email' => $email,
                'mobile' => $mobile,
            ];

            $userDetails = array_filter($userDetails);
            $userDetails['createdTime'] = $timestamp;
            $userDetails['updateTime'] = $timestamp;
            App::getBean('NewModels')->getModelsObject('Data', 'RegisterData')->insertTableUserDetails($userDetails);

            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            $this->message = $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * 检测account是否存在
     * @param string $account
     * @return bool
     */
    public function existsAccount(string $account): bool
    {
        return App::getBean('NewModels')->getModelsObject('Data', 'RegisterData')->existsAccount($account);
    }
}