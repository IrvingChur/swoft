<?php
/**
 * auth: IrvingChur
 */

namespace App\Common\Controller;

use Swoft\Bean\Annotation\Bean;
/**
 * Class Response
 * @package App\Common\Controller
 * @Bean("Response")
 */
class Response
{
    private $format;

    public function __construct()
    {
        $this->format = [
            'code' => 200,
            'data' => [],
            'message' => '',
        ];
    }

    /**
     * @param array|null $data
     * @param string $message
     */
    public function normalResponse(?array $data, string $message = '请求成功')
    {
        $this->format['data'] = $data;
        $this->format['message'] = $message;
        return $this->ultimately();
    }

    /**
     * @param string $message
     */
    public function errorResponse(string $message = '请求异常')
    {
        $this->format['code'] = 500;
        $this->format['message'] = $message;
        return $this->ultimately();
    }

    private function ultimately()
    {
        $code = $this->format['code'];
        $data = $this->format['data'];
        $message = $this->format['message'];

        return compact('code', 'data', 'message');
    }
}