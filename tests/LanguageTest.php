<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\widgets\languages;

class LanguageTest extends TestCase
{
    public function setUp(): void
    {
        require_once(dirname(__DIR__) . '/config/init.php');
    }

    public function test_lang_tmp_dir()
    {
        $lang = new \App\widgets\languages\Language();
        $reflectionProperty = new \ReflectionProperty(\App\widgets\languages\Language::class, 'tpl');

        $this->assertEquals('/home/vagrant/code/ishop/app/widgets/languages/lang_tpl.php', $reflectionProperty->getValue($lang));
    }
    public function test_lang_layout_tmp()
    {
        $lang = new \Wfm\Language();
        $this->assertEquals('/home/vagrant/code/ishop/app/languages/ru/Main/index.php', $lang->load('ru', ['controller' => 'Main', 'action' => 'index']));
    }
}