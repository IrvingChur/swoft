<?php
/**
 * auth: IrvingChur
 */

namespace App\Models\Data;

use Swoft\App;

/**
 * Class RegisterData
 * @package App\Models\Data
 */
class RegisterData
{
    /**
     * 插入table:user
     * @param array $data
     * @return int
     */
    public function insertTableUser(array $data): int
    {
        $userDao = App::getBean('NewModels')->getModelsObject('Dao', 'UserDao');
        return $userDao->insertUser($data);
    }

    /**
     * 插入table:user_details
     * @param array $data
     * @return int
     */
    public function insertTableUserDetails(array $data): int
    {
        $userDetailsDao = App::getBean('NewModels')->getModelsObject('Dao', 'UserDetailsDao');
        return $userDetailsDao->insertUserDetails($data);
    }

    /**
     * 检测account是否存在
     * @param string $account
     * @return bool
     */
    public function existsAccount(string $account): bool
    {
        $userDao = App::getBean('NewModels')->getModelsObject('Dao', 'UserDao');
        return $userDao->existsUser($account);
    }
}