<?php

namespace Gpor\Gantt;


class Gantt extends GporBase
{

    /**
     * @var \Gpor\Gantt\Column[$dayIso]
     */
    public $columns = [];

    /**
     * @var \Gpor\Gantt\ColumnGroup[]
     */
    public $columnGroups = [];

    /**
     * percentage
     * @var float
     */
    public $columnWidth;

    /**
     * @var \Gpor\Gantt\RowGroup[]
     */
    public $rowGroups = [];

    public function defaultTemplate()
    {
        return 'gantt';
    }

    /**
     * needs to be done after all columns set and before rendering
     */
    public function calculateColumns()
    {
        $n = count($this->columns);
        $i = 0;
        foreach ($this->columns as $col) {
            $col->setLeftPos($i, $n);
            $i++;
        }
        foreach ($this->columnGroups as $colGroup) {
            $colGroup->setLeftPos();
        }
        $this->columnWidth = 100 / $n;
    }
}