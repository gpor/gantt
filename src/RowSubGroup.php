<?php

namespace Gpor\Gantt;


class RowSubGroup extends GporBase
{
    public $label;

    /**
     * @var \Gpor\Gantt\RowGroup
     */
    public $rowGroup;

    /**
     * NB set in $this->calculateTotals() NEVER externally
     * @var int
     */
    public $tasks = 0;

    /**
     * @var \Gpor\Gantt\Column|NULL
     */
    public $startColumn;

    /**
     * @var \Gpor\Gantt\Column|NULL
     */
    public $endColumn;

    public function defaultTemplate()
    {
        return 'rowSubGroup';
    }

    /**
     * @var \Gpor\Gantt\Row[]
     */
    public $rows = [];

    public function tasks()
    {
        $tasks = 0;
        foreach ($this->rows as $row) {
            $tasks += $row->tasks;
        }
        return $tasks;
    }

    /**
     * called after all rows set
     */
    public function calculateTotals()
    {
        foreach ($this->rows as $row) {
            $this->tasks += $row->tasks;
            if ($this->startColumn === null || $row->startColumn->leftPos < $this->startColumn->leftPos) {
                $this->startColumn = $row->startColumn;
            }
            if ($this->endColumn === null || $row->endColumn->leftPosEnd > $this->endColumn->leftPosEnd) {
                $this->endColumn = $row->endColumn;
            }
        }
    }
}