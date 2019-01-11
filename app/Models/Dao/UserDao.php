<?php

namespace App\Models\Dao;

use App\Models\Entity\User;
use Swoft\App;

/**
 * Class UserDao
 * @package App\Models\Dao
 */
class UserDao
{

    // 用户状态[0:正常 1:禁用]
    const USER_STATUS_NORMAL = 0;
    const USER_STATUS_DISABLED = 1;

    public $userInfo;

    /**
     * 插入用户信息
     * @param array $data
     * @return int
     */
    public function insertUser(array $data): int
    {
        $userEntity = App::getBean('NewModels')->getModelsObject('Entity', 'User');
        $existsUser = $this->existsUser($data['account']);

        if ($existsUser === false) {
            return $userEntity->fill($data)->save()->getResult();
        } else {
            throw new \InvalidArgumentException("账号已存在");
        }
    }

    /**
     * 检测账户是否存在
     * @param string $account
     * @return bool
     */
    public function existsUser(string $account): bool
    {
        $map = ['account' => $account];

        $userInfo = User::findOne($map)->getResult();
        if ($userInfo !== null) {
            $this->userInfo = $userInfo->toArray();
            return true;
        }

        return false;
    }
}
