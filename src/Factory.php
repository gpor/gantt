<?php

namespace Gpor\Gantt;


class Factory
{

    public static function newGantt($columnGroupsData, $row_groups_data)
    {
        $gantt = new Gantt;
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

    public static function newColumnGroup($data, $gantt)
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

    private static function newRowGroup($data, \Gpor\Gantt\Gantt $gantt)
    {
        $rowGroup = new RowGroup;
        $rowGroup->gantt    = $gantt;
        $rowGroup->icon     = $data['icon'];
        $rowGroup->label    = $data['label'];
        $rowGroup->stages   = $data['stages'];
        foreach ($data['subgroups'] as $subgroup_data) {
            $rowSubGroup = self::newRowSubGroup($subgroup_data, $rowGroup);
            $rowGroup->rowSubGroups[] = $rowSubGroup;
        }
        $rowGroup->calculateTotals();
        $rowGroup->bar = self::newBar($rowGroup, $gantt);
        return $rowGroup;
    }

    private static function newBar($row_or_group, $gantt)
    {
        $bar = new Bar;
        $bar->gantt = $gantt;
        $bar->row_or_group = $row_or_group;
        return $bar;
    }

    private static function newRowSubGroup($data, \Gpor\Gantt\RowGroup $rowGroup)
    {
        $rowSubGroup            = new RowSubGroup;
        $rowSubGroup->rowGroup  = $rowGroup;
        $rowSubGroup->label     = $data['label'];
        foreach ($data['rows'] as $row_data) {
            $row = self::newRow($row_data, $rowSubGroup);
            $rowSubGroup->rows[] = $row;
        }
        $rowSubGroup->calculateTotals();
        return $rowSubGroup;
    }

    private static function newRow($data, \Gpor\Gantt\RowSubGroup $rowSubGroup)
    {
        $row = new Row;
        $row->subGroup      = $rowSubGroup;
        $row->rowLabel      = $data['rowLabel'];
        $row->tasks         = $data['tasks'];
        $row->cssClasses    = explode(' ', $data['cssClass']);
        $startCol           = $rowSubGroup->rowGroup->gantt->columns[$data['start']];
        $endCol             = $rowSubGroup->rowGroup->gantt->columns[$data['end']];
        $row->startColumn   = $startCol;
        $row->endColumn     = $endCol;
        $row->bar           = self::newBar($row, $rowSubGroup->rowGroup->gantt);
//        $row->bar->cssClass = 'gg-thinner';
        return $row;
    }

    private static function newColumn($iso)
    {
        $col = new Column;
        $col->timestamp = strtotime($iso);
        return $col;
    }
}