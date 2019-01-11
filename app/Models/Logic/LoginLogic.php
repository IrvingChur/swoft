<?php
/**
 * auth: IrvingChur
 */

namespace App\Models\Logic;


use App\Models\Entity\UserLogin;
use Swoft\App;

class LoginLogic
{
    public $message = '';
    public $data = [];

    /**
     * 登录逻辑
     * @param string $account
     * @param string $password
     */
    public function login(string $account, string $password): bool
    {
        $result = App::getBean('NewModels')->getModelsObject('Data', 'LoginData')->login($account);
        if (empty($result)) {
            $this->message = '账号不存在';
            return false;
        } else {
            // delete password index
            unset($result['password']);
        }

        $timestamp = App::getBean('Common')->getTimestamp();

        // 验证登录次数
        $exception = $this->checkException($result['id']);
        if ($exception === true) {
            // 异常登录
            $this->message = '密码错误次数过多，请稍后再重试';
            return false;
        }

        // 验证登录密码
        $exception = 0;
        $password = md5($password);
        if ($password !== $result['password']) {
            // 密码不正确逻辑
            $this->message = '密码不正确';
            $exception = 1;
        } elseif ($result['status'] === 1) {
            $this->message = '用户被禁用';
            return false;
        } else {
            $this->message = '登录成功';
            // 生成token并保存信息
            $token = $result['account'];
            $token = md5($token.UserLogin::USER_LOGIN_KEY);
            $loginToken = $result;
            $loginToken['token'] = $token;
            $loginToken = serialize($loginToken);
            $this->data = ['account' => $result['account'], 'token' => base64_encode($loginToken)];
        }
        $userLoginData = [
            'userId' => $result['id'],
            'exception' => $exception,
            'created_time' => $timestamp,
            'update_time' => $timestamp,
        ];

        // 增加登录记录
        App::getBean('NewModels')->getModelsObject('Data', 'LoginData')->recordLogin($userLoginData);

        return true;
    }

    /**
     * 检测异常登录 异常条件:30分钟内错误登录5次
     * @param int $userId
     * @return bool
     */
    private function checkException(int $userId): bool
    {
        return App::getBean('NewModels')->getModelsObject('Data', 'LoginData')->checkException($userId);
    }
}