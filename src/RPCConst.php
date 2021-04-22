<?php

namespace XinMo\RPC;

class RPCConst
{
    const HTTP_METHOD_GET    = 'GET';
    const HTTP_METHOD_POST   = 'POST';
    const HTTP_METHOD_PUT    = 'PUT';
    const HTTP_METHOD_DELETE = 'DELETE';

    const RPC_PROTOCOL_HTTP      = 'http';
    const RPC_PROTOCOL_REST      = 'rest';
    const RPC_PROTOCOL_TCP       = 'tcp';
    const RPC_PROTOCOL_WEBSOCKET = 'websocket';
    const RPC_PROTOCOL_LOCAL     = 'local';
}
