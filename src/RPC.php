<?php

namespace XinMo\RPC;

class RPC extends RESTful
{
    private $service;
    private $uri;
    private $method;
    private $params;

    public function __construct(
        $service
    ) {
        $this->service = $service;
    }

    public function request(
        $uri,
        $method = RPCConst::HTTP_METHOD_GET,
        $params = []
    ) {
        $this->uri    = $uri;
        $this->method = $method;
        $this->params = $params;

        return $this->parseURI();
    }

    protected function parseURI()
    {
        $str         = '([a-zA-Z]+)([a-zA-Z_]*)';
        $str_123     = $str . '\/' . '([0-9]+)';
        $str_str     = $str . '\/' . $str;
        $str_str_str = $str_str . '\/' . $str;
        $str_str_123 = $str . '\/' . $str_123;

        $str_123_str         = $str_123 . '\/' . $str;
        $str_123_str_123     = $str_123 . '\/' . $str_123;
        $str_123_str_str     = $str_123 . '\/' . $str_str;
        $str_123_str_str_str = $str_123 . '\/' . $str_str_str;
        $str_123_str_str_123 = $str_123 . '\/' . $str_str_123;

        $this->uri = trim($this->uri, '/');
        $ids       = [];
        if (preg_match("/^$str$/", $this->uri)) {
            $class = $this->service . '\\' . $this->uri . '\\Index';
            $func  = $this->str();
        } elseif (preg_match("/^$str_123$/", $this->uri)) {
            list($dir, $ids[]) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir);
            $func  = $this->str_123();
        } elseif (preg_match("/^$str_str$/", $this->uri)) {
            list($dir, $file) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($file);
            $func  = $this->str_str();
        } elseif (preg_match("/^$str_str_str$/", $this->uri)) {
            list($dir, $file, $func) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($file);
            $func  = $this->str_str_str($func);
        } elseif (preg_match("/^$str_str_123$/", $this->uri)) {
            list($dir, $file, $ids[]) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($file);
            $func  = $this->str_str_123();
        } elseif (preg_match("/^$str_123_str$/", $this->uri)) {
            list($dir, $ids[], $dir2) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($dir2) . '\\Index';
            $func  = $this->str();
        } elseif (preg_match("/^$str_123_str_123$/", $this->uri)) {
            list($dir, $ids[], $dir2, $ids[]) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($dir2);
            $func  = $this->str_123();
        } elseif (preg_match("/^$str_123_str_str$/", $this->uri)) {
            list($dir, $ids[], $dir2, $file) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($dir2) . '\\' . ucwords($file);
            $func  = $this->str_str();
        } elseif (preg_match("/^$str_123_str_str_str$/", $this->uri)) {
            list($dir, $ids[], $dir2, $file, $func) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($dir2) . '\\' . ucwords($file);
            $func  = $this->str_str_str($func);
        } elseif (preg_match("/^$str_123_str_str_123$/", $this->uri)) {
            list($dir, $ids[], $dir2, $file, $ids[]) = explode('/', $this->uri);
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($dir2) . '\\' . ucwords($file);
            $func  = $this->str_str_123();
        }
        $class = $this->nameReplace($class);

        $obj = new $class(...$ids);
        //        var_dump($obj, $func);
        //        exit;

        return call_user_func_array([$obj, $func], [$this->params]);
    }

    protected function nameReplace($name)
    {
        return str_replace('_', '', ucwords($name, '_'));
    }

    protected function str()
    {
        if ($this->method == 'GET') {
            $func = 'index';
        } elseif ($this->method == 'POST') {
            $func = 'insert';
        } elseif ($this->method == 'DELETE') {
            $func = 'drop';
        } else {

        }

        return $func;
    }

    protected function str_123()
    {
        if ($this->method == 'GET') {
            $func = 'view';
        } elseif ($this->method == 'PUT') {
            $func = 'update';
        } elseif ($this->method == 'DELETE') {
            $func = 'delete';
        } else {

        }

        return $func;
    }

    protected function str_str()
    {
        if ($this->method == 'GET') {
            $func = 'index';
        } elseif ($this->method == 'POST') {
            $func = 'insert';
        }

        return $func;
    }

    protected function str_str_str($func)
    {
        return lcfirst($this->nameReplace($func));
    }

    protected function str_str_123()
    {
        if ($this->method == 'GET') {
            $func = 'view';
        } elseif ($this->method == 'UPDATE') {
            $func = 'update';
        }

        return $func;
    }
}
