<?php

namespace Gpor\Gantt;


class Gantt extends GporBase
{

    /**
     * @var \Gpor\Gantt\Column[$dayIso]
     */
    public $columns = [];

    /**
     * @var \Gpor\Gantt\Column
     */
    public $firstCol;

    /**
     * @var \Gpor\Gantt\Column
     */
    public $lastCol;

    /**
     * @var \Gpor\Gantt\ColumnGroup[]
     */
    public $columnGroups = [];

    /**
     * @var \Gpor\Gantt\ColumnsHeader
     */
    public $columnsHeader;

    /**
     * percentage
     * @var float
     */
    public $columnWidth;

    /**
     * @var \Gpor\Gantt\RowGroup[]
     */
    public $rowGroups = [];

    /**
     * @var bool
     */
    public $isMobile = false;

    public function defaultTemplate()
    {
        return ($this->isMobile)? 'mobile-gantt' : 'gantt';
    }

    /**
     * needs to be done after all columns set and before rendering
     */
    public function calculateColumns()
    {
        $n = count($this->columns);
        $i = 0;
        foreach ($this->columns as $col) {
            if ($this->firstCol === null) $this->firstCol = $col;
            $this->lastCol = $col;
            $col->setLeftPos($i, $n);
            $i++;
        }
        foreach ($this->columnGroups as $colGroup) {
            $colGroup->setLeftPos();
        }
        $this->columnWidth = 100 / $n;
    }
}