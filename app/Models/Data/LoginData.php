<?php
/**
 * auth: IrvingChur
 */

namespace App\Models\Data;


use Swoft\App;

class LoginData
{
    /**
     * 登录
     * @param string $account
     * @param string $password
     * @return array
     */
    public function login(string $account): array
    {
        $userDao = App::getBean('NewModels')->getModelsObject('Dao', 'UserDao');
        $existsUser = $userDao->existsUser($account);

        // 返回该账号信息
        if ($existsUser === true) {
            return $userDao->userInfo;
        } else {
            return [];
        }
    }

    /**
     * 记录登录时间
     * @param array $data
     * @return bool
     */
    public function recordLogin(array $data): bool
    {
        $userLoginDao = App::getBean('NewModels')->getModelsObject('Dao', 'UserLoginDao');
        return $userLoginDao->insertUserLoginDetails($data) ? true : false ;
    }

    /**
     * 检测异常登录
     * @param int $userId
     * @return bool
     */
    public function checkException(int $userId): bool
    {
        $userLoginDao = App::getBean('NewModels')->getModelsObject('Dao', 'UserLoginDao');
        return $userLoginDao->checkException($userId);
    }
}