<?php /* @var $this \Gpor\Gantt\Row */ ?>
<div class="gg-row-outer <?= $this->cssClass() ?> gg-thinner">
    <div class="gg-row-label">
        <div class="col-expand-hide-clickable"></div>
        <div class="col-graphic">
            <i class="fa fa-circle-o dept-color-{{ $sign->name }}" aria-hidden="true"></i>
        </div>
        <div class="col-text">
            <h3><?= $this->rowLabel ?> <span class="tasks-text">(<?= $this->bar->tasks ?> Tasks)</span></h3>
        </div>
    </div>
    <?= $this->bar ?>
</div>
