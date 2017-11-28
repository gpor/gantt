<?php

namespace Gpor\Gantt;


class DatesHelper
{
    public $startDate;
    public $numOfDays;
    public $lastDate;
    public $_dayIntStartDate;
    
    const SECONDS_IN_DAY = 86400;
    const FIRST_DAY_OF_WEEK = '1';

    public static function ganttColGroups($startIsoDate, $endIsoDate)
    {
        $begin = new \DateTime($startIsoDate);
        $end_left = (new \DateTime($endIsoDate));
        if ((int)($end_left->diff($begin))->format('%a') > 56) {
            $format_test = 'd';
            $first_day_num = '01';
            $label_format = 'F';
            $end = $end_left->modify( '+1 month' );
        } else {
            $format_test = 'w';
            $first_day_num = self::FIRST_DAY_OF_WEEK;
            $label_format = 'd/m';
            $end = $end_left->modify( '+1 day' );
        }

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);

        $groups = [];
        $group = null;

        foreach($daterange as $date){
            if (date($format_test, $date->getTimestamp()) === $first_day_num) {
                if ($format_test === 'w' && isset($previous_date, $group)) $group['label'] .= ' - '.$previous_date;
                if ($group !== null) $groups[] = $group;
                $group = self::ganttColGroup($date->format($label_format));
            } elseif ($group === null) {
                $group = self::ganttColGroup($date->format($label_format));
            } else {
            }
            $previous_date = $date->format($label_format);
            $group['days'][] = $date->format("Y-m-d");
        }
        return $groups;
    }

    private static function ganttColGroup($label)
    {
        return [
            'label' => $label,
            'days' => [],
        ];
    }

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

    public static function byWeeks($startIsoDate, $numDaysInGroup = 7, $numOfGroups = 8)
    {
        $dayIntStart = self::dayInt($startIsoDate);
        $groups = [];
        for ($group = 0; $group < $numOfGroups; $group++) {
            $dayIntWeekStart    = $dayIntStart + ($group * $numDaysInGroup);
            $dayIntWeekLastDay  = $dayIntWeekStart + $numDaysInGroup - 1;
            $groups[] = [
                'label'     => self::rangeLabel($dayIntWeekStart * self::SECONDS_IN_DAY, $dayIntWeekLastDay * self::SECONDS_IN_DAY),
                'days'      => self::groupFill($dayIntWeekStart, $numDaysInGroup),
            ];
        }
        return $groups;
    }

    public static function rangeLabel($firstDateUnix, $lastDayUnix)
    {
        $firstDayDay           = date('j', $firstDateUnix);
        $firstDayMonth         = date('M', $firstDateUnix);
        $lastDayDay            = date('j', $lastDayUnix);
        $lastDayMonth          = date('M', $lastDayUnix);
        if ($firstDayMonth === $lastDayMonth) {
            return "$firstDayDay - $lastDayDay $lastDayMonth";
        } else {
            return "$firstDayDay $firstDayMonth - $lastDayDay $lastDayMonth";
        }
    }
}