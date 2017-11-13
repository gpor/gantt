<?php

namespace Gpor\Gantt;


class MobileInfo extends GporBase
{
    /**
     * @var \Gpor\Gantt\RowSubGroup
     */
    public $subGroup;

    public function defaultTemplate()
    {
        return 'mobileInfo';
    }
}