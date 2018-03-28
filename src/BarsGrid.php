<?php

namespace Gpor\Gantt;


class BarsGrid extends GporBase
{
    /**
     * @var \Gpor\Gantt\Row|\Gpor\Gantt\RowSubGroup|\Gpor\Gantt\RowGroup
     */
    public $row;

    /**
     * @var \Gpor\Gantt\Gantt
     */
    public $gantt;

    public function __construct($row, Gantt $gantt)
    {
        $this->row = $row;
        $this->gantt = $gantt;
    }

    public function defaultTemplate()
    {
        return 'barsGrid';
    }

    /**
     * @return \Gpor\Gantt\Bar[]
     */
    public function bars()
    {
        if ( ! is_object($this->row)) {
            dd($this);
        }
        return (property_exists($this->row, 'bars'))
            ? $this->row->bars
            : [$this->row->bar];
    }
}