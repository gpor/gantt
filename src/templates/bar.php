<?php /* @var $this \Gpor\Gantt\Bar */
$text = $this->text();
$dataTextAttr = $this->dataTextAttr();
$titleAttr = $this->titleAttr();
?>
<?php if ($this->showBar): ?>
<div class="gg-bar"
     <?php if ($this->gantt->barTitleAttrs): ?>
     title="<?= $titleAttr ?>"
     <?php else: ?>
     data-text="<?= $text ?>"
     <?php endif ?>
     data-misc="<?= htmlspecialchars(json_encode($this->miscData)) ?>"
     style="<?= $this->style() ?>">
    <div class="gg-bar-color <?= $this->cssClass() ?>">
        <?php if ($this->gantt->barTextShow): ?>
        <p><?= $text ?></p>
        <?php endif ?>
    </div>
</div>
<?php endif ?>
