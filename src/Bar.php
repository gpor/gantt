<?php

namespace Gpor\Gantt;


class Bar extends GporBase
{
    public $text;
    public $gantt;
    public $row_or_group;
    public $cssClass = '';

    /**
     * if this is FALSE, the only property required is $gantt (to do grid lines)
     * @var bool
     */
    public $showBar = true;

    public function defaultTemplate()
    {
        return 'bar';
    }

    public function style()
    {
        return $this->row_or_group->startColumn->barDimensions($this->row_or_group->endColumn);
    }
//
//    public function text()
//    {
//        return DateFill::dateRange(
//            $this->row_or_group->startColumn->timestamp,
//            $this->row_or_group->endColumn->timestamp
//        );
//    }
}