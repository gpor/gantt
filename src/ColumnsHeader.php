<?php

namespace Gpor\Gantt;


class ColumnsHeader extends GporBase
{
    /**
     * @var \Gpor\Gantt\Gantt
     */
    public $gantt;

    public function defaultTemplate()
    {
        return 'columnsHeader';
    }
}