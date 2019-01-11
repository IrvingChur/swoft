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
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Request;
use App\Models\Logic\RegisterLogic;
use Swoft\Bean\Annotation\Strings;
use Swoft\Bean\Annotation\ValidatorFrom;
use App\Common\Controller\Response;
// use Swoft\View\Bean\Annotation\View;
// use Swoft\Http\Message\Server\Response;

/**
 * Class RegisterController
 * @Controller(prefix="/register")
 * @package App\Controllers\User
 */
class RegisterController{
    /**
     * Create a new record. access uri path: /register
     * @RequestMapping(route="/register", method=RequestMethod::POST)
     * @Strings(from=ValidatorFrom::POST, name="nickname", min=3, max=25, default="", template="字段{name}必须在{min}到{max}之间,您提交的值是{value}")
     * @Strings(from=ValidatorFrom::POST, name="account", min=3, max=25, default="", template="字段{name}必须在{min}到{max}之间,您提交的值是{value}")
     * @Strings(from=ValidatorFrom::POST, name="password", min=3, max=25, default="", template="字段{name}必须在{min}到{max}之间,您提交的值是{value}")
     * @return array
     */
    public function post(Request $request): array
    {
        $nickname = $request->post('nickname', '');
        $account = $request->post('account', '');
        $password = $request->post('password', '');
        $wechatAccount = $request->post('wechatAccount', '');
        $email = $request->post('email', '');
        $mobile = $request->post('mobile', '');
        $photoUrl = '';

        // 图片上传
        $photoUrlFile = $request->getUploadedFiles();
        $photoUrlFile = $photoUrlFile['photoUrlFile'];

        if (!empty($photoUrlFile)) {
            $photoUrl = $this->uploadImageFile($photoUrlFile);
        }

        // 转到logic层
        $logic = App::getBean('NewModels')->getModelsObject('Logic', 'RegisterLogic');
        $result = $logic->register($nickname, $account, $password, $wechatAccount, $email, $mobile, $photoUrl);

        return App::getBean('Response')->normalResponse([], $result ? '注册成功' : $logic->message);
    }

    /**
     * 检测account是否存在
     * @RequestMapping(route="/register", method=RequestMethod::GET)
     * @Strings(from=ValidatorFrom::GET, name="account", min=3, max=25, default="", template="字段{name}必须在{min}到{max}之间,您提交的值是{value}")
     * @param Request $request
     * @return array
     */
    public function get(Request $request): array
    {
        $account = $request->query('account', '');
        if (empty($account)) {
            return App::getBean('Response')->errorResponse('account不能为空');
        }

        $logic = App::getBean('NewModels')->getModelsObject('Logic', 'RegisterLogic');
        $result = $logic->existsAccount($account);

        return App::getBean('Response')->normalResponse([], $result ? '账号已存在' : '账号不存在');
    }

    /**
     * upload image file handle
     * @param \Swoft\Http\Message\Upload\UploadedFile $file
     * @param string $dir
     * @return string
     */
    private function uploadImageFile(\Swoft\Http\Message\Upload\UploadedFile $file, string $dir = '/photo'): string
    {
        $dir = alias('@public').$dir;
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }

        //检验格式
        $fileType = $file->getClientMediaType();
        if (!in_array($fileType, ['image/jpeg', 'image/jpg', 'image/png'])) {
            return '';
        }

        $ext = end(explode('.', $file->getClientFilename()));
        $fileName = uniqid().'.'.$ext;
        $path = $dir.'/'.$fileName;
        $file->moveTo($path);

        return '/photo/'.$fileName;
    }
}
