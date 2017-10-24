<?php

namespace Gpor\Gantt;


class RowGroup extends GporBase
{
    public $icon;
    public $label;
    public $stages;
    public $barText;

    /**
     * index for this instance within $gantt->columnGroups
     * @var int
     */
    public $i;

    /**
     * @var \Gpor\Gantt\Bar
     */
    public $bar;

    /**
     * @var \Gpor\Gantt\
     */
    public $gantt;

    /**
     * NB set in $this->calculateTotals() NEVER externally
     * @var int
     */
    public $tasks = 0;

    /**
     * @var \Gpor\Gantt\Column|NULL
     */
    public $startColumn;

    /**
     * @var \Gpor\Gantt\Column|NULL
     */
    public $endColumn;

    public function defaultTemplate()
    {
        return 'rowGroup';
    }

    /**
     * @var \Gpor\Gantt\RowSubGroup[]
     */
    public $rowSubGroups = [];

    public function tasks()
    {
        $tasks = 0;
        foreach ($this->rowSubGroups as $rowSubGroup) {
            $tasks += $rowSubGroup->tasks();
        }
        return $tasks;
    }

    /**
     * called after all rows set
     */
    public function calculateTotals()
    {
        foreach ($this->rowSubGroups as $rowSubGroups) {
            $this->tasks += $rowSubGroups->tasks;
            if ($this->startColumn === null || $rowSubGroups->startColumn->leftPos < $this->startColumn->leftPos) {
                $this->startColumn = $rowSubGroups->startColumn;
            }
            if ($this->endColumn === null || $rowSubGroups->endColumn->leftPosEnd > $this->endColumn->leftPosEnd) {
                $this->endColumn = $rowSubGroups->endColumn;
            }
        }
    }
}