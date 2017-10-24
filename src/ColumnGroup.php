<?php

namespace Gpor\Gantt;


class ColumnGroup extends GporBase
{
    public $label;
    /**
     * @var \Gpor\Gantt\Column[]
     */
    public $columns = [];

    /**
     * @var number percentage
     */
    public $leftPos = 0;

    public function setLeftPos()
    {
        $this->leftPos = $this->columns[0]->leftPos;
    }

    public function style()
    {
        return $this->columns[0]->barDimensions($this->columns[count($this->columns)-1]);
    }
}