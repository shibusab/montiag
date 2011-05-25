<?php
interface ICache 
{
   public function get($key, $expiration = 3600);
   public function set($key, $data);
   public function clear($key);
   public function clearAll();
}

?>