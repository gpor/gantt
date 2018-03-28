<?php /* @var $this \Gpor\Gantt\Bar */
$text = $this->text();
?>
<?php if ($this->showBar): ?>
<div class="gg-bar"
     <?php if ($this->gantt->barTitleAttrs): ?>
     title="<?= $text ?>"
     <?php else: ?>
     data-text="<?= $text ?>"
     <?php endif ?>
     style="<?= $this->style() ?>">
    <div class="gg-bar-color <?= $this->cssClass() ?>">
        <?php if ($this->gantt->barTextShow): ?>
        <p><?= $text ?></p>
        <?php endif ?>
    </div>
</div>
<?php endif ?>
