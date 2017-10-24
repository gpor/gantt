<?php

namespace Gpor\Gantt;


class DateFill
{
    public $startDate;
    public $numOfDays;
    public $lastDate;
    public $_dayIntStartDate;
    
    const SECONDS_IN_DAY = 86400;

    public function output()
    {
        $arr = [];
        for ($t = $this->dayIntStartDate(); $t < $this->dayIntNextStartDate(); $t++) {
            $arr[] = date('Y-m-d', $t * self::SECONDS_IN_DAY);
        }
        return $arr;
    }
    
    private function dayIntStartDate()
    {
        if ($this->_dayIntStartDate === null) {
            $this->_dayIntStartDate = self::dayInt($this->startDate);
        }
        return $this->_dayIntStartDate;
    }
    
    
    public function dayIntNextStartDate()
    {
        if ($this->numOfDays !== null) {
            return $this->dayIntStartDate() + $this->numOfDays;
        }
        if ($this->lastDate !== null) {
            return self::dayInt($this->lastDate) + 1;
        }
    }

    private static function dayInt($isoDate)
    {
        return round(strtotime($isoDate) / (3600 * 24));
    }

    public static function byNumOfDays($startDate, $numOfDays)
    {
        $inst = new self;
        $inst->startDate = $startDate;
        $inst->numOfDays = $numOfDays;
        return $inst->output();
    }
    
    public static function groupFill($dayIntStart, $numOfDays)
    {
        $inst = new self;
        $inst->_dayIntStartDate = $dayIntStart;
        $inst->numOfDays = $numOfDays;
        return $inst->output();
    }

    public static function byWeeks($startIsoDate, $numDaysInGroup = 7, $numOfGroups = 4)
    {
        $dayIntStart = self::dayInt($startIsoDate);
        $groups = [];
        for ($group = 0; $group < $numOfGroups; $group++) {
            $dayIntWeekStart    = $dayIntStart + ($group * $numDaysInGroup);
            $dayIntWeekLastDay  = $dayIntWeekStart + $numDaysInGroup - 1;
            $groups[] = [
                'label'     => self::dateRange($dayIntWeekStart * self::SECONDS_IN_DAY, $dayIntWeekLastDay * self::SECONDS_IN_DAY),
                'days'      => self::groupFill($dayIntWeekStart, $numDaysInGroup),
            ];
        }
        return $groups;
    }

    public static function dateRange($firstDateUnix, $lastDayUnix)
    {
        $firstDayDay           = date('d', $firstDateUnix);
        $firstDayMonth         = date('M', $firstDateUnix);
        $lastDayDay            = date('d', $lastDayUnix);
        $lastDayMonth          = date('M', $lastDayUnix);
        if ($firstDayMonth === $lastDayMonth) {
            return "$firstDayDay - $lastDayDay $lastDayMonth";
        } else {
            return "$firstDayDay $firstDayMonth - $lastDayDay $lastDayMonth";
        }
    }
}