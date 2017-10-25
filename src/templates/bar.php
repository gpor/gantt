<?php /* @var $this \Gpor\Gantt\Bar */ ?>
<div class="gg-bar-outer">
    <div class="gg-row">
        <?php if ($this->showBar): ?>
        <div class="gg-bar" style="<?= $this->style() ?>">
            <div class="gg-bar-color <?= $this->cssClass() ?>">
                <p><?= $this->text ?></p>
            </div>
        </div>
        <?php endif ?>
    </div>
    <?php foreach ($this->gantt->columnGroups as $columnGroup): ?>
        <div class="grid-line" style="left:<?= $columnGroup->leftPos ?>%"></div>
    <?php endforeach ?>
</div>
