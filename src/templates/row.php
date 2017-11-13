<?php /* @var $this \Gpor\Gantt\Row */ ?>
<div class="gg-row-outer <?= $this->cssClass() ?> gg-thinner">
    <?php if ( ! $this->subGroup->rowGroup->gantt->isMobile): ?>
        <?= $this->rowLabelElement ?>
    <?php endif ?>
    <?= $this->bar ?>
</div>
