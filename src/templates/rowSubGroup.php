<?php /* @var $this \Gpor\Gantt\RowSubGroup */ ?>
<div class="gg-row-sub-group">
    <div class="gg-row-outer gg-thinner gg-row-sub-group-head-row gg-pink">
        <div class="gg-row-label">
            <div class="col-expand-hide-clickable"></div>
            <div class="col-graphic"></div>
            <div class="col-text">
                <h3><?= $this->label ?></span></h3>
            </div>
        </div>
        <?= $this->bar ?>
    </div>
    <?php foreach($this->rows as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>
