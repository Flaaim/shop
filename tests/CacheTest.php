<?php

namespace Test;

use Wfm\Cache;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    public $cache;

    public function setUp(): void
    {
        require_once(dirname(__DIR__) . '/config/init.php');
        $this->cache = Cache::getInstance();
    }

    public function test_set_cache()
    {
        $this->assertTrue($this->cache->set('p', 'Hello', 30));
    }
    public function test_what_can_get_cache()
    {
        $this->assertEquals('Hello', $this->cache->get('p'));
    }
    public function test_what_can_delete_cache()
    {
        $this->cache->delete('p');
        $this->assertFalse(file_exists(CACHE . '/'.md5('p').'.txt'));
    }
}