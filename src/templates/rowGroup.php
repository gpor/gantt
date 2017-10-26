<?php /* @var $this \Gpor\Gantt\RowGroup */ ?>
<div class="gg-row-outer gg-pink gg-group-head" data-groupindex="<?= $this->i ?>">
    <div class="gg-row-label">
        <div class="col-expand-hide-clickable">
            <span>+</span>
        </div>
        <div class="col-graphic">
            <img src="<?= $this->icon ?>" />
        </div>
        <div class="col-text">
            <h3>
                <?php if ($this->labelHref): ?>
                <a href="<?= $this->labelHref ?>">
                <?php endif ?>
                    <?= $this->label ?> <span class="tasks-text">(<?= $this->bar->tasks ?> <?= str_plural('Task', $this->bar->tasks) ?>)</span>
                <?php if ($this->labelHref): ?>
                </a>
                <?php endif ?>
            </h3>
        </div>
    </div>
    <?= $this->bar ?>
</div>
<div class="gg-group-rows" id="gg-group-rows-<?= $this->i ?>">
    <div class="gg-group-rows-inner">
        <?php foreach($this->rowSubGroups as $subGroup): ?>
            <?= $subGroup ?>
        <?php endforeach ?>
    </div>
</div>
