<?php /* @var $this \Gpor\Gantt\RowGroup */ ?>
<div class="gg-row-outer gg-pink gg-group-head" data-groupindex="<?= $this->i ?>">
    <div class="gg-row-label">
        <?php if ( ! $this->gantt->config['isMobile']): ?>
            <div class="col-expand-hide-clickable desktop-version">
                <span class="fa fa-plus" data-closedstate="fa-plus" data-openstate="fa-minus"></span>
            </div>
        <?php endif ?>
        <div class="col-graphic">
            <img src="<?= $this->icon ?>" />
        </div>
        <div class="col-text">
            <h3>
                <?php if ($this->labelHref): ?>
                <a href="<?= $this->labelHref ?>">
                <?php endif ?>
                    <?= $this->label ?>
                    <?php if ($this->bar->tasks !== null): ?>
                    <span class="tasks-text">(<?= $this->bar->tasks ?> <?= str_plural('Task', $this->bar->tasks) ?>)</span>
                    <?php endif ?>
                <?php if ($this->labelHref): ?>
                </a>
                <?php endif ?>
            </h3>
        </div>
        <?php if ($this->gantt->config['isMobile']): ?>
            <div class="col-expand-hide-clickable">
                <span class="fa fa-angle-down" data-closedstate="fa-angle-down" data-openstate="fa-angle-up"></span>
            </div>
        <?php endif ?>
    </div>
    <?php if ( ! $this->gantt->config['isMobile']) echo $this->bar ?>
</div>
<div class="gg-group-rows" id="gg-group-rows-<?= $this->i ?>">
    <div class="gg-group-rows-inner">
        <div class="columns-header-mobile">
            <?= $this->gantt->columnsHeader ?>
        </div>
        <?php foreach($this->rowSubGroups as $subGroup): ?>
            <?= $subGroup ?>
        <?php endforeach ?>
        <?php if ($this->gantt->config['isMobile']): ?>
        <div class="gg-mobile-info">
            <?php foreach($this->rowSubGroups as $subGroup): ?>
                <?php if (true): ?>
                <?= $subGroup->mobileInfo ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <?php endif ?>
    </div>
</div>
