<?php /* @var $this \Gpor\Gantt\BarsGrid */ ?>
<div class="gg-bar-outer">
    <div class="gg-row">
        <?php foreach ($this->bars() as $bar): ?>
            <?= $bar ?>
        <?php endforeach ?>
    </div>
    <?php foreach ($this->gantt->columnGroups as $columnGroup): ?>
        <div class="grid-line" style="left:<?= $columnGroup->leftPos ?>%"></div>
    <?php endforeach ?>
</div>
