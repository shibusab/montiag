<?php
// ViewData is the simple data structure used to wrap the data passed from
//   the controller to the view
class ViewData Implements ArrayAccess, Iterator {
    private $vars = array();

    function __construct() {        
    }

    function set($key, $var) {
            if (isset($this->vars[$key]) == true) {
                    throw new Exception('Unable to set var `' . $key . '`. Already set.');
            }

            $this->vars[$key] = $var;
            return true;
    }

    function get($key) {
            if (isset($this->vars[$key]) == false) {
                    return null;
            }

            return $this->vars[$key];
    }

    function remove($var) {
            unset($this->vars[$key]);
    }

    function offsetExists($offset) {
            return isset($this->vars[$offset]);
    }

    function offsetGet($offset) {
            return $this->get($offset);
    }

    function offsetSet($offset, $value) {
            $this->set($offset, $value);
    }

    function offsetUnset($offset) {
            unset($this->vars[$offset]);
    }
    
    public function key()
    {
        return key($this->vars);
    }

    public function current()
    {
        return current($this->vars);
    }

    public function next()
    {
        return next($this->vars);
    }

    public function rewind()
    {
        return reset($this->vars);
    }

    public function valid()
    {
        // When Next passes over the end of the array,
        // current() should return false. Needs to be tested.
        return (bool) $this->current();
    }

}
?>