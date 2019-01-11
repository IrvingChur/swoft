<?php
/**
 * auth: IrvingChur
 */

namespace App\Models\Dao;


use Swoft\App;

class UserDetailsDao
{
    /**
     * 插入用户信息详情
     * @param array $data
     */
    public function insertUserDetails(array $data)
    {
        $userDetailsEntity = App::getBean('NewModels')->getModelsObject('Entity', 'UserDetails');
        return $userDetailsEntity->fill($data)->save()->getResult();
    }
}