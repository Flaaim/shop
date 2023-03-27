<?php

namespace Wfm;

use Wfm\TSingleton;

class Registry
{
    use Tsingleton;

    protected static $properties = [];

    public function getProperty($value)
    {
        return self::$properties[$value] ?? null;
    }
    public function setProperty($key, $value)
    {
        self::$properties[$key] = $value;
    }
    public function getProperties(): array
    {
        return self::$properties;
    }
}
