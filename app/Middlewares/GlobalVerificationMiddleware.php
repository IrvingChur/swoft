<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Bean\Annotation\Bean;

/**
 * Class GlobalVerification
 * @package App\Middlewares
 * @Bean()
 */
class GlobalVerificationMiddleware implements MiddlewareInterface
{
    // 验证秘钥
    const SECRET_KEY = 'FBAD4B6F1E710DDF1A3D37106D096688';

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $verification = $this->verification($request);

        // 验证失败时
        if ($verification !== true) {
            // 返回状态码
            return response()->withStatus(500);
        }

        $response = $handler->handle($request);
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    protected function verification(ServerRequestInterface $request):bool
    {
        $secretKey = $request->getHeader('secretKey')[0];
        $debugMode = $request->getHeader('debugMode')[0];

        if (!empty($debugMode) && (string)$debugMode === 'debug') {
            return true;
        }

        $return = false;
        if (!empty($secretKey)) {
            //验证逻辑:md5(当前小时 + 秘钥)
            $hours = date('m', time());
            $calculate = $hours.self::SECRET_KEY;
            $calculate = md5($calculate);

            if ($calculate === $debugMode) {
                $return = true;
            }
        }

        return $return;
    }
}