<?php
class MyArrayObject extends ArrayObject
{
    protected $data = array();
    public function offsetGet($name) {
        return $this->data[$name];
    }
    public function offsetSet($name, $value) {
        $this->data[$name] = $value;
    }
    public function offsetExists($name) {
        return isset($this->data[$name]);
    }
    public function offsetUnset($name) {
        unset($this->data[$name]);
    }
}
?>