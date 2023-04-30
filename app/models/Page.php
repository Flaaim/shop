<?php

namespace App\Models;

use App\Models\AppModel;
use RedBeanPHP\R;

class Page extends AppModel
{
    public function get_page($slug, $lang): array
    {
        return R::getRow("SELECT * FROM page JOIN page_description ON page.id = page_description.page_id
        WHERE page.slug = ? AND page_description.language_id = ?", [$slug, $lang['id']]);
    }
}