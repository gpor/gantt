<?php /* @var $this \Gpor\Gantt\ColumnsHeader */ ?>
<div class="gg-bar-outer">
    <?php foreach ($this->gantt->columnGroups as $columnGroup): ?>
        <div class="gg-head-cell" style="<?= $columnGroup->style() ?>">
            <p class="text"><?= $columnGroup->label ?></p>
        </div>
    <?php endforeach ?>
</div>


