<?php

namespace Gpor\Gantt;


class Column extends GporBase
{

    public $name = '';
    public $timestamp;

    /**
     * @var number percentage
     */
    public $leftPos = 0;
    public $leftPosEnd = 0;

    public function setLeftPos($i, $n)
    {
        $this->leftPos = $i / $n * 100;
        $this->leftPosEnd = ($i+1) / $n * 100;
    }

    /**
     * returns inline css style. This column instance will be the startColumn
     * @param GanttColumn $endColumn
     * @return string
     */
    public function barDimensions(Column $endColumn)
    {
        $width = $endColumn->leftPosEnd - $this->leftPos;
        return "left: {$this->leftPos}%; width: $width%;";
    }
}