<?php

namespace Gpor\Gantt;


class Row extends GporBase
{

    public $rowLabelText;

    /**
     * @var \Gpor\Gantt\RowLabel
     */
    public $rowLabelElement;
    public $labelHref;
    public $barText;
    public $cssClasses = [];

    /**
     * @var \Gpor\Gantt\Bar[]
     */
    public $bars = [];

    /**
     * UP ref
     * @var \Gpor\Gantt\RowSubGroup
     */
    public $subGroup;

    public function defaultTemplate()
    {
        return 'row';
    }
//
//    public function style()
//    {
//        return $this->startColumn->barDimensions($this->endColumn);
//    }

    public function cssClass()
    {
        return implode(' ', $this->cssClasses);
    }

    /**
     * @return FALSE|number (FALSE means that none of the bars have tasks number set)
     */
    public function totalTasks()
    {
        if ($this->_totalTasks === null) {
            $this->_totalTasks = false;
            foreach ($this->bars as $bar) {
                if ($bar->tasks !== null) {
                    if ($this->_totalTasks === false) {
                        $this->_totalTasks = 0;
                    }
                    $this->_totalTasks += $bar->tasks;
                }
            }
        }
        return $this->_totalTasks;
    }
    private $_totalTasks;

    /**
     * @return BarsGrid
     */
    public function barsGrid()
    {
        if ($this->_barsGrid === null) {
            $this->_barsGrid = new BarsGrid($this, $this->subGroup->rowGroup->gantt);
        }
        return $this->_barsGrid;
    }
    private $_barsGrid;
}