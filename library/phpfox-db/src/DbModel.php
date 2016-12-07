<?php

namespace Phpfox\Db;

use Phpfox\Model\ModelInterface;

abstract class DbModel implements ModelInterface
{
    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @var array
     */
    protected $_changed = [];

    /**
     * @var bool
     */
    protected $_saved = false;

    public function __construct($data = null, $saved = false)
    {
        if ($data) {
            $this->_data = $data;
        }
        $this->_saved = $saved;
    }

    public function toArray()
    {
        return $this->_data;
    }

    public function exchangeArray($array)
    {
        $this->_data = $array;
    }

    public function isSaved()
    {
        return $this->_saved;
    }

    public function markSaved()
    {
        $this->_saved = true;
        return $this;
    }

    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]);
    }

    public function offsetGet($offset)
    {
        return @$this->_data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->_data[] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    function __get($name)
    {
        return $this->_data[$name];
    }

    function __set($name, $value)
    {
        $this->_data[$name] = $value;
        $this->_changed[$name] = 1;
    }

    public function delete()
    {
        $this->beforeDelete();
        \Phpfox::getModel($this->getModelId())
            ->delete($this);
        $this->afterDelete();
    }

    protected function beforeDelete()
    {

    }

    protected function afterDelete()
    {

    }

    public function save()
    {

        if (empty($this->_changed)) {
            return false;
        }

        $gateway = \Phpfox::getModel($this->getModelId());

        if ($this->_saved) {
            $this->beforeUpdate();
            $gateway->update($this);
            $this->afterUpdate();
        } else {
            $this->beforeCreate();
            $gateway->insert($this);
            $this->afterCreate();
        }

        // reset status
        $this->_saved = true;
        $this->_changed = [];

        return $this;
    }

    protected function beforeUpdate()
    {
    }

    protected function afterUpdate()
    {

    }

    protected function beforeCreate()
    {

    }

    protected function afterCreate()
    {
    }

    public function getChanged()
    {
        return array_intersect_key($this->_data, $this->_changed);
    }

    public function __sleep()
    {
        return ['_data', '_changed', '_saved'];
    }
}