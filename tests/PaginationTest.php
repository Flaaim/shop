<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use \Wfm\Pagination;

class PaginationTest extends TestCase
{
    public function test_get_params()
    {
        $pagination = new Pagination(1, 3, 6);
        
    }
    public function test_getCountPages()
    {
        $pagination = new Pagination(1, 3, 6);
        
        $this->assertEquals(2, $pagination->getCountPages());
    }

    public function test_get_current_page()
    {
        $pagination = new Pagination(3, 3, 6);
        $this->assertEquals(2, $pagination->getCurrentPage(3));
    }

    public function test_true_is_true()
    {
        $this->assertTrue(true);
    }
}