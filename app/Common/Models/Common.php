<?php

namespace App\Common\Models;

use \Swoft\Bean\Annotation\Bean;

/**
 * Class Common
 * @package App\Common\Models
 * @Bean("Common")
 */
class Common
{

    /**
     * @return string
     */
    public function getTimestamp():string
    {
        $time = time();
        return date('Y-m-d H:i:s', $time);
    }

}