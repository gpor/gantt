<?php /* @var $this \Gpor\Gantt\Gantt */ ?>
<div class="gpor-gantt">
    <div class="gg-header">
        <div class="gg-row-label">
            <div class="col-expand-hide-clickable">
                <span class="fa fa-plus" data-closedstate="fa-plus" data-openstate="fa-minus"></span>
            </div>
            <div class="col-graphic">
            </div>
            <div class="col-text"><?= $this->config['labelCol'] ?></div>
        </div>
        <?= $this->columnsHeader ?>
    </div>
    <?php foreach($this->rowGroups as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>




