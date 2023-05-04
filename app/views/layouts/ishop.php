<?php

use Wfm\View;

?>
<?php $this->getPart('header') ?>
<?php $this->getPart('flash_messages') ?>
<?php echo $this->content ?>

<?php $this->getPart('footer'); ?>


