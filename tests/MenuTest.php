<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\widgets\menu\Menu;
use Wfm\App;

class MenuTest extends TestCase
{

    protected $menu;

    public function setUp(): void
    {
        require_once(dirname(__DIR__) . '/config/init.php');

        $this->menu = new Menu(['cache' => 0]);
    }

    public function test_what_can_change_menu_properties()
    {
        
        $reflectionProperty = new \ReflectionProperty($this->menu, 'cache');
        $this->assertEquals(0, $reflectionProperty->getValue($this->menu));
    }

    
}