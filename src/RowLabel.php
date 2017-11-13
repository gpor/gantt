<?php

namespace Gpor\Gantt;


class RowLabel extends GporBase
{
    /**
     * @var \Gpor\Gantt\Row
     */
    public $row;

    public function defaultTemplate()
    {
        return 'rowLabel';
    }
}