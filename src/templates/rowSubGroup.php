<?php /* @var $this \Gpor\Gantt\RowSubGroup */ ?>
<div class="gg-row-sub-group">
    <?php if ( ! $this->rowGroup->gantt->config['isMobile']): ?>
    <div class="gg-row-outer gg-thinner gg-row-sub-group-head-row gg-pink <?= $this->headRowCssClass ?>">
        <div class="gg-row-label">
            <div class="col-expand-hide-clickable"></div>
            <div class="col-graphic"></div>
            <div class="col-text">
                <?php if ($this->labelHref): ?>
                <a href="<?= $this->labelHref ?>">
                <?php endif ?>
                    <h3><?= $this->label ?></span></h3>
                <?php if ($this->labelHref): ?>
                </a>
                <?php endif ?>
            </div>
        </div>
        <?= $this->barsGrid() ?>
    </div>
    <?php endif ?>
    <?php foreach($this->rows as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>
