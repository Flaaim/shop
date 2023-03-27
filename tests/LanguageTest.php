<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\widgets\languages\Language;

class LanguageTest extends TestCase
{


    public function test_lang_tmp_dir()
    {
        $lang = new Language;
        $reflection = new \ReflectionClass($lang);
        $this->assertEquals('/home/vagrant/code/ishop/app/widgets/languages/lang_tpl.php', $reflection->getProperty('tpl')->getValue(new Language));
    }

    
}