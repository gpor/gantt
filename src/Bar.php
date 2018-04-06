<?php

namespace Gpor\Gantt;


class Bar extends GporBase
{
    /**
     * @var \Gpor\Gantt\Gantt
     */
    public $gantt;
    public $cssClasses = [];

    public $truncated_left = false;
    public $truncated_right = false;

    /**
     * NB. if $truncated_left, this will be $gantt->firstCol
     * @var \Gpor\Gantt\Column
     */
    public $startColumn;

    /**
     * NB. if $truncated_right, this will be $gantt->lastCol
     * @var \Gpor\Gantt\Column
     */
    public $endColumn;

    /**
     * @var string ISO date
     */
    public $start_date;

    /**
     * @var string ISO date
     */
    public $end_date;

    /**
     * if this is FALSE, the only property required is $gantt (to do grid lines)
     * @var bool
     */
    public $showBar = true;

    /**
     * @var int|NULL
     */
    public $tasks = null;

    /**
     * @var array key=>val useful for Gantt lambda functions barTextFunction($bar), barTitleAttrFunction($bar), barDataTextAttrFunction($bar)
     */
    public $miscData = [];

    public function defaultTemplate()
    {
        return 'bar';
    }

    public function style()
    {
        return $this->startColumn->barDimensions($this->endColumn);
    }

    public function cssClass()
    {
        return implode(' ', $this->cssClasses);
    }

    /**
     * Finds the columns in which this coloured bar starts and ends. also, whether the bar is truncated
     */
    private function setPointsColumns()
    {
        $columns = $this->gantt->columns;
        $start = $this->start_date;
        $end = $this->end_date;
        if ( ! $start && ! $end) {
            $this->showBar = false;
            return false;
        }
        if ($end < $this->gantt->firstCol->iso) {
            $this->showBar = false;
            return false;
        }
        if ($start > $this->gantt->lastCol->iso) {
            $this->showBar = false;
            return false;
        }

        if (isset($columns[$start])) {
            $this->startColumn = $columns[$start];
        } else {
            $this->startColumn = $this->gantt->firstCol;
            $this->cssClasses[] = 'truncated-left';
            $this->truncated_left = true;
        }
        if (isset($columns[$end])) {
            $this->endColumn = $columns[$end];
        } else {
            $this->endColumn = $this->gantt->lastCol;
            $this->cssClasses[] = 'truncated-right';
            $this->truncated_right = true;
        }
        return true;
    }

    public function text()
    {
        if (is_callable($this->gantt->barTextFunction)) {
            $text = call_user_func_array($this->gantt->barTextFunction, [$this]);
        }
        return (isset($text))
            ? $text
            : DatesHelper::rangeLabel(strtotime($this->start_date), strtotime($this->end_date));
    }

    public function titleAttr()
    {
        if (is_callable($this->gantt->barTitleAttrFunction)) {
            return call_user_func_array($this->gantt->barTitleAttrFunction, [$this]);
        } else {
            return $this->text();
        }
    }

    public function dataTextAttr()
    {
        if (is_callable($this->gantt->barDataTextAttrFunction)) {
            return call_user_func_array($this->gantt->barDataTextAttrFunction, [$this]);
        } else {
            return $this->titleAttr();
        }
    }

    /**
     * calculate start and end points that no child bars exceed. (make this the 'super' bar of its children)
     * NB for every bar, either this method of setPointsFromDates() is called during calculateTotals() in a parent object
     * @param $barContainers array NB each element needs to be an object with $bar property containing Bar instance
     */
    public function setPointsFromChildBars($barContainers)
    {
        $start_date_manually_set = ( !! $this->start_date);
        $end_date_manually_set = ( !! $this->end_date);
        foreach ($barContainers as $barContainer) {
            $childBars = (property_exists($barContainer, 'bars'))
                ? $barContainer->bars
                : [$barContainer->bar];
            foreach ($childBars as $childBar) {
                if ($childBar->tasks !== null) {
                    $this->tasks += $childBar->tasks;
                }
                if ( ! $start_date_manually_set) {
                    if ($this->start_date === null || $childBar->start_date < $this->start_date) {
                        $this->start_date = $childBar->start_date;
                    }
                }
                if ( ! $end_date_manually_set) {
                    if ($this->end_date === null || $childBar->end_date > $this->end_date) {
                        $this->end_date = $childBar->end_date;
                    }
                }
            }
        }
        $this->setPointsColumns();
    }

    /**
     * NB for every bar, either this method of setPointsFromChildBars() is called during calculateTotals() in a parent object
     * @param string $startIso
     * @param string $endIso
     */
    public function setPointsFromDates($startIso, $endIso)
    {
        $this->start_date = $startIso;
        $this->end_date = $endIso;
        $this->setPointsColumns();
    }
}