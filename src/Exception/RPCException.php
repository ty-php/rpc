<?php
namespace XinMo\RPC\Exception;

class RPCException extends \Exception
{
    const MSG = [
    ];

    public function __construct($code, $error = null)
    {
        if (!$error) {
            if (isset(static::MSG[$code])) {
                $error = self::MSG[$code];
            } else {
                $error = '未定义异常';
            }
        }

        $this->error   = $error;
        $this->message = is_array($error) ? json_encode($error, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE) : $error;
        $this->code    = $code;
    }

    public function getError()
    {
        return $this->error;
    }
}
