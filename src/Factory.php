<?php

namespace Gpor\Gantt;


class Factory
{

    public static function newGantt($columnGroupsData, $row_groups_data, $config = [])
    {
        $config = array_merge([
            'isMobile'      => false,
            'labelCol'      => 'Project Name',
        ], $config);
        $gantt = new Gantt;
        $gantt->config = $config;
        $gantt->columnsHeader = self::newColumnsHeader($gantt);
        foreach ($columnGroupsData as $columnGroupData) {
            $colGroup = self::newColumnGroup($columnGroupData, $gantt);
            $gantt->columnGroups[] = $colGroup;
        }
        $gantt->calculateColumns();
        foreach ($row_groups_data as $row_group_data) {
            $rowGroup = self::newRowGroup($row_group_data, $gantt);
            $gantt->rowGroups[] = $rowGroup;
            $rowGroup->i = count($gantt->rowGroups) - 1;
        }
        return $gantt;
    }

    public static function newColumnsHeader(Gantt $gantt)
    {
        $columnsHeader = new ColumnsHeader();
        $columnsHeader->gantt = $gantt;
        return $columnsHeader;
    }

    public static function newRowLabel(Row $row)
    {
        $rowLabel = new RowLabel();
        $rowLabel->row = $row;
        return $rowLabel;
    }

    public static function newMobileInfo(RowSubGroup $subGroup)
    {
        $mobileInfo = new MobileInfo();
        $mobileInfo->subGroup = $subGroup;
        return $mobileInfo;
    }

    public static function newColumnGroup($data, Gantt $gantt)
    {
        $colGroup               = new ColumnGroup;
        $colGroup->label        = $data['label'];
        foreach ($data['days'] as $dayIso) {
            $col = self::newColumn($dayIso);
            $colGroup->columns[] = $col;
            $gantt->columns[$dayIso] = $col;
        }
        return $colGroup;
    }

    protected static function newRowGroup($data, Gantt $gantt)
    {
        $rowGroup = new RowGroup;
        $rowGroup->gantt    = $gantt;
        $rowGroup->icon     = $data['icon'];
        $rowGroup->label    = $data['label'];
        if (isset($data['labelHref'])) $rowGroup->labelHref = $data['labelHref'];
        foreach ($data['subgroups'] as $subgroup_data) {
            $rowSubGroup = self::newRowSubGroup($subgroup_data, $rowGroup);
            $rowGroup->rowSubGroups[] = $rowSubGroup;
        }
        $rowGroup->bar          = self::newBar($gantt, $data);
        $rowGroup->calculateTotals();
        return $rowGroup;
    }

    /**
     * @param \Gpor\Gantt\Gantt $gantt
     * @param array ['start' => ... 'end' => ... ] optional: miscBarData, tasks, cssClass
     * @return Bar
     */
    protected static function newBar(Gantt $gantt, $data)
    {
        $bar = new Bar;
        $bar->gantt = $gantt;
        if (isset($data['start'])) {
            $bar->start_date = $data['start'];
        }
        if (isset($data['end'])) {
            $bar->end_date = $data['end'];
        }
        if (isset($data['showBar'])) {
            $bar->showBar = $data['showBar'];
        }
        if (isset($data['miscBarData'])) {
            $bar->miscData = $data['miscBarData'];
        }
        if (isset($data['tasks'])) {
            $bar->tasks = $data['tasks'];
        }
        if (isset($data['cssClass'])) {
            $bar->cssClasses[] = $data['cssClass'];
        }
        return $bar;
    }

    protected static function newRowSubGroup($data, RowGroup $rowGroup)
    {
        $rowSubGroup            = new RowSubGroup;
        $rowSubGroup->rowGroup  = $rowGroup;
        $rowSubGroup->label     = $data['label'];
        if (isset($data['labelHref'])) $rowSubGroup->labelHref = $data['labelHref'];
        if (isset($data['headRowCssClass'])) $rowSubGroup->headRowCssClass = $data['headRowCssClass'];
        foreach ($data['rows'] as $row_data) {
            $row = self::newRow($row_data, $rowSubGroup);
            $rowSubGroup->rows[] = $row;
        }
        $noBar                  = self::newBar($rowGroup->gantt, $data);
        $noBar->showBar         = false;
        $rowSubGroup->bar       = $noBar;
        $rowSubGroup->calculateTotals();
        $rowSubGroup->mobileInfo = self::newMobileInfo($rowSubGroup);
        return $rowSubGroup;
    }

    protected static function newRow($data, RowSubGroup $rowSubGroup)
    {
        $gantt = $rowSubGroup->rowGroup->gantt;
        $row = new Row;
        $row->subGroup      = $rowSubGroup;
        $row->rowLabelText  = $data['rowLabel'];
        if (isset($data['labelHref'])) $row->labelHref = $data['labelHref'];
        $row->cssClasses    = explode(' ', $data['cssClass']);
        $bars_data = (isset($data['bars']))
            ? $data['bars']
            : [
                [
                    'tasks' => (isset($data['tasks'])? $data['tasks'] : null),
                    'start' => $data['start'],
                    'end' => $data['end'],
                ],
            ];
        foreach ($bars_data as $bar_data) {
            $bar = self::newBar($gantt, $bar_data);
            $bar->setPointsFromDates($bar_data['start'], $bar_data['end']);
            $row->bars[] = $bar;
        }
        $row->rowLabelElement = self::newRowLabel($row);
        return $row;
    }

    protected static function newColumn($iso)
    {
        $col = new Column;
        $col->iso = $iso;
        $col->timestamp = strtotime($iso);
        return $col;
    }
}