<?php /* @var $this \Gpor\Gantt\Row */ ?>
<div class="gg-row-outer <?= $this->cssClass() ?> gg-thinner">
    <div class="gg-row-label">
        <div class="col-expand-hide-clickable"></div>
        <div class="col-graphic">
            <i class="fa fa-circle-o dept-color-{{ $sign->name }}" aria-hidden="true"></i>
        </div>
        <div class="col-text">
            <?php if ($this->labelHref): ?>
            <a href="<?= $this->labelHref ?>">
            <?php endif ?>
                <h3><?= $this->rowLabel ?>
                    <?php if ($this->bar->tasks !== null): ?>
                    <span class="tasks-text">(<?= $this->bar->tasks ?> <?= str_plural('Task', $this->bar->tasks) ?>)</span></h3>
                    <?php endif ?>
            <?php if ($this->labelHref): ?>
            </a>
            <?php endif ?>
        </div>
    </div>
    <?= $this->bar ?>
</div>
