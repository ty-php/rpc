<?php

namespace XinMo\RPC\Exception;

class RPCUserException extends RPCException
{
    const USER_BADGE_NOT_EXIST      = 100001;
    const USER_AUTHOR_BADGE_LIMIT_3 = 100002;

    const MSG = [
        self::USER_BADGE_NOT_EXIST      => '勋章不存在',
        self::USER_AUTHOR_BADGE_LIMIT_3 => '作家勋章数不能超过3个',
    ];

    public function __construct($code, $error = null)
    {
        parent::__construct($code, $error);
    }
}
