<?php /* @var $this \Gpor\Gantt\RowLabel */ ?>
<div class="gg-row-label">
    <div class="col-expand-hide-clickable"></div>
    <div class="col-graphic color-like-bar">
        <i class="fa fa-circle-o" aria-hidden="true"></i>
    </div>
    <div class="col-text">
        <?php if ($this->row->labelHref): ?>
        <a href="<?= $this->row->labelHref ?>">
        <?php endif ?>
            <h3><?= $this->row->rowLabelText ?>
                <?php if ($this->row->bar->tasks !== null): ?>
                <span class="tasks-text">(<?= $this->row->bar->tasks ?> <?= str_plural('Task', $this->row->bar->tasks) ?>)</span>
                <?php endif ?>
            </h3>
        <?php if ($this->row->labelHref): ?>
        </a>
        <?php endif ?>
    </div>
</div>
