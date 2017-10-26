<?php

namespace Gpor\Gantt;


class RowGroup extends GporBase
{
    public $icon;
    public $label;
    public $barText;
    public $labelHref;

    /**
     * @var \Gpor\Gantt\RowSubGroup[]
     */
    public $rowSubGroups = [];

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
     * UP ref
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
     * called after all rows set
     */
    public function calculateTotals()
    {
        $this->bar->setPointsFromChildBars($this->rowSubGroups);
    }
}