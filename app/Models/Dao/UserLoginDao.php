<?php
/**
 * auth: IrvingChur
 */

namespace App\Models\Dao;


use App\Models\Entity\UserLogin;
use Swoft\App;

class UserLoginDao
{
    // 登录状态[0:正常 1:异常]
    const USER_LOGIN_NORMAL = 0;
    const USER_LOGIN_EXCEPTION = 1;

    // 用户登录秘钥
    const USER_LOGIN_KEY = 'login';

    /**
     * 插入用户登录信息
     * @param int $userId
     * @param int $exception
     * @return int
     */
    public function insertUserLoginDetails(array $data): int
    {
        $userLoginEntity = App::getBean('NewModels')->getModelsObject('Entity', 'UserLogin');
        return $userLoginEntity->fill($data)->save()->getResult();
    }

    /**
     * 检测异常登录
     * @param int $userId
     * @return bool
     */
    public function checkException(int $userId): bool
    {
        // 限制登录条件 30分钟内超过5次异常登录
        $time = time();
        $exTime = $time - (30 * 60);
        $time = date('Y-m-d H:i:s', $time);
        $exTime = date('Y-m-d H:i:s', $exTime);

        $result = UserLogin::query()
            ->where('exception', self::USER_LOGIN_EXCEPTION)
            ->where('user_id', $userId)
            ->where('created_time', $exTime, '>=')
            ->where('created_time', $time, '<=')
            ->get()
            ->getResult();

        // 判断并返回结果
        $exception = false;
        if (!empty($result)) {
            $result = $result->toArray();
            $count = count($result);
            if ($count >= 5) {
                $exception = true;
            }
        }

        return $exception;
    }
}