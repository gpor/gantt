<?php /* @var $this \Gpor\Gantt\MobileInfo */ ?>
<?php foreach ($this->subGroup->rows as $row): ?>
    <div class="mobile-info-row <?= $row->cssClass() ?>">
        <?= $row->rowLabelElement ?>
    </div>
<?php endforeach ?>



