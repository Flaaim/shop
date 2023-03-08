<?php

use Wfm\View;

?>
<?= $this->getPart('header') ?>
<?= $this->content ?>
<?= $this->getPart('footer') ?>
<?= $this->getDbLogs() ?>