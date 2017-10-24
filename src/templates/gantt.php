<?php /* @var $this \Gpor\Gantt\Gantt */ ?>
<div class="gpor-gantt">
    <div class="gg-header">
        <div class="gg-row-label">
            <div class="col-expand-hide-clickable"></div>
            <div class="col-graphic">
            </div>
            <div class="col-text">PROJECT NAME</div>
        </div>
        <div class="gg-bar-outer">
            <?php foreach ($this->columnGroups as $columnGroup): ?>
                <div class="gg-head-cell" style="<?= $columnGroup->style() ?>">
                    <p class="text"><?= $columnGroup->label ?></p>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php foreach($this->rowGroups as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>




