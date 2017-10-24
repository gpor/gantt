<?php

namespace Gpor\Gantt;


class Row extends GporBase
{

    public $rowLabel;
    public $barText;
    public $cssClasses = [];

    /**
     * @var \Gpor\Gantt\Bar
     */
    public $bar;

    /**
     * @var \Gpor\Gantt\RowSubGroup
     */
    public $subGroup;

    /**
     * @var int
     */
    public $tasks;

    /**
     * @var \Gpor\Gantt\Column
     */
    public $startColumn;

    /**
     * @var \Gpor\Gantt\Column
     */
    public $endColumn;

    public function defaultTemplate()
    {
        return 'row';
    }

    public function style()
    {
        return $this->startColumn->barDimensions($this->endColumn);
    }

    public function cssClass()
    {
        return implode(' ', $this->cssClasses);
    }
}