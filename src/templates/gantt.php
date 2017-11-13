<?php /* @var $this \Gpor\Gantt\Gantt */ ?>
<div class="gpor-gantt">
    <div class="gg-header">
        <div class="gg-row-label">
            <div class="col-expand-hide-clickable"></div>
            <div class="col-graphic">
            </div>
            <div class="col-text">PROJECT NAME</div>
        </div>
        <?= $this->columnsHeader ?>
    </div>
    <?php foreach($this->rowGroups as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>




