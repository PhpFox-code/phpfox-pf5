<?php
namespace Phpfox\Support;


class ParameterBag
{
    protected $data = [];

    public function all()
    {
        return $this->data;
    }

    public function reset()
    {
        $this->data = [];
    }

    public function get($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->data[$key]);
    }

    public function add($data)
    {
        foreach ($data as $k => $v) {
            $this->data[$k] = $v;
        }
        return $this;
    }
}