<?php

namespace XinMo\RPC\Protocol;

use XinMo\RPC\RESTful;

/**
 * 本地调用类
 */
class Local extends RESTful
{
    public function execute()
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
            $class = $this->service . '\\' . ucwords($this->uri) . '\\Index';
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
            $class = $this->service . '\\' . ucwords($dir) . '\\' . ucwords($dir2) . '\\Index';
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

    /**
     * 路由规则：/str method对应方法名
     * @return string
     */
    protected function str()
    {
        if ($this->method == 'GET') {
            $func = 'index';
        } elseif ($this->method == 'POST') {
            $func = 'insert';
        } elseif ($this->method == 'DELETE') {
            $func = 'drop';
        }  elseif ($this->method == 'PUT') {
            $func = 'update';
        } else {

        }

        return $func;
    }

    /**
     * 路由规则：/str/123 method对应方法名
     * @return string
     */
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

    /**
     * 路由规则：/str/str method对应方法名
     * @return string
     */
    protected function str_str()
    {
        if ($this->method == 'GET') {
            $func = 'index';
        } elseif ($this->method == 'POST') {
            $func = 'insert';
        }

        return $func;
    }

    /**
     * 路由规则：/str/str/str method对应方法名
     * @return string
     */
    protected function str_str_str($func)
    {
        return lcfirst($this->nameReplace($func));
    }

    /**
     * 路由规则：/str/str/123 method对应方法名
     * @return string
     */
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
