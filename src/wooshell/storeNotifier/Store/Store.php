<?php

namespace wooshell\storeNotifier\Store;

class Store
{
    private $notifications = array();

    public function add($key, $value)
    {
        $this->notifications[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function get($key)
    {
        if (false === isset($this->notifications[$key])) {
            return false;
        }

        return $this->notifications[$key];
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function exists($key, $value)
    {
        return $this->get($key) && in_array($value, $this->get($key));
    }
}
