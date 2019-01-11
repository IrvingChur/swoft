<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\User;

use Swoft\App;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Strings;
use Swoft\Bean\Annotation\ValidatorFrom;
// use Swoft\View\Bean\Annotation\View;
// use Swoft\Http\Message\Server\Response;

/**
 * Class LoginController
 * @Controller(prefix="/login")
 * @package App\Controllers\User
 */
class LoginController{
    /**
     * Get data list. access uri path: /login
     * @RequestMapping(route="/login", method=RequestMethod::GET)
     * @return array
     */
    public function index(): array
    {
        return ['item0', 'item1'];
    }

    /**
     * Get one by ID. access uri path: /login/{id}
     * @RequestMapping(route="{id}", method=RequestMethod::GET)
     * @return array
     */
    public function get(): array
    {
        return ['item0'];
    }

    /**
     * Create a new record. access uri path: /login
     * @RequestMapping(route="/login", method=RequestMethod::POST)
     * @Strings(from=ValidatorFrom::POST, name="account", min=3, max=25, default="", template="字段{name}必须在{min}到{max}之间,您提交的值是{value}")
     * @Strings(from=ValidatorFrom::POST, name="password", min=3, max=25, default="", template="字段{name}必须在{min}到{max}之间,您提交的值是{value}")
     * @return array
     */
    public function post(Request $request): array
    {
        $account = $request->post('account', '');
        $password = $request->post('password', '');

        $logic = App::getBean('NewModels')->getModelsObject('Logic', 'LoginLogic');
        $logic->login($account, $password);

        return App::getBean('Response')->normalResponse($logic->data, $logic->message);
    }

    /**
     * Update one by ID. access uri path: /login/{id}
     * @RequestMapping(route="{id}", method=RequestMethod::PUT)
     * @return array
     */
    public function put(): array
    {
        return ['id' => 1];
    }

    /**
     * Delete one by ID. access uri path: /login/{id}
     * @RequestMapping(route="{id}", method=RequestMethod::DELETE)
     * @return array
     */
    public function del(): array
    {
        return ['id' => 1];
    }
}
