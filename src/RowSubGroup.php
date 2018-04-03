<?php

namespace Gpor\Gantt;


class RowSubGroup extends GporBase
{

    /**
     * @var \Gpor\Gantt\Row[]
     */
    public $rows = [];

    /**
     * @var string
     */
    public $label;
    public $labelHref;

    /**
     * UP ref
     * @var \Gpor\Gantt\RowGroup
     */
    public $rowGroup;

    /**
     * @var \Gpor\Gantt\Column|NULL
     */
    public $startColumn;

    /**
     * @var \Gpor\Gantt\Column|NULL
     */
    public $endColumn;

    /**
     * @var \Gpor\Gantt\Bar
     */
    public $bar;

    /**
     * @var \Gpor\Gantt\MobileInfo
     */
    public $mobileInfo;

    /**
     * @var string
     */
    public $headRowCssClass = '';

    public function defaultTemplate()
    {
        return 'rowSubGroup';
    }

    /**
     * called after all rows set
     */
    public function calculateTotals()
    {
        $this->bar->setPointsFromChildBars($this->rows);
    }

    /**
     * @return BarsGrid
     */
    public function barsGrid()
    {
        if ($this->_barsGrid === null) {
            $this->_barsGrid = new BarsGrid($this, $this->rowGroup->gantt);
        }
        return $this->_barsGrid;
    }
    private $_barsGrid;
}