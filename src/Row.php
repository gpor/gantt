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
     * @var \Gpor\Gantt\Bar
     */
    public $bar;

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
}