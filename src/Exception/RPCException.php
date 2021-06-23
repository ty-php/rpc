<?php
namespace XinMo\RPC\Exception;

class RPCException extends \Exception
{
    public function __construct($code, $error = null)
    {
        $this->error   = $error;
        $this->message = is_array($error) ? json_encode($error, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE) : $error;
        $this->code    = $code;
    }

    public function getError()
    {
        return $this->error;
    }
}
