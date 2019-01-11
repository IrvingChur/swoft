<?php
/**
 * auth: IrvingChur
 */

namespace App\Common\Models;

use Swoft\Bean\Annotation\Bean;
/**
 * Class NewModels
 * @package App\Common\Models
 * @Bean("NewModels")
 */
class NewModels
{
    public function getModelsObject(string $type, string $className)
    {
        switch ($type) {
            case 'Logic' :
                $namespace = 'App\\Models\\Logic';
                break;
            case 'Dao' :
                $namespace = 'App\\Models\\Dao';
                break;
            case 'Data' :
                $namespace = 'App\\Models\\Data';
                break;
            case 'Entity' :
                $namespace = 'App\\Models\\Entity';
                break;
            default :
                throw new \InvalidArgumentException();
                break;
        }

        // 创建并返回对象
        $class = $namespace.'\\'.$className;

        if (class_exists($class)) {
            return new $class();
        } else {
            throw new \InvalidArgumentException();
        }
    }
}