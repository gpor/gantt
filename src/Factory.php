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

    private static function newRowGroup($data, Gantt $gantt)
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

    /**
     * @param \Gpor\Gantt\RowGroup|\Gpor\Gantt\Row|NULL $row_or_group
     * @param \Gpor\Gantt\Gantt $gantt
     * @return Bar
     */
    private static function newBar($row_or_group, Gantt $gantt)
    {
        $bar = new Bar;
        $bar->gantt = $gantt;
        $bar->row_or_group = $row_or_group;
        return $bar;
    }

    private static function newRowSubGroup($data, RowGroup $rowGroup)
    {
        $rowSubGroup            = new RowSubGroup;
        $rowSubGroup->rowGroup  = $rowGroup;
        $rowSubGroup->label     = $data['label'];
        foreach ($data['rows'] as $row_data) {
            $row = self::newRow($row_data, $rowSubGroup);
            $rowSubGroup->rows[] = $row;
        }
        $noBar                  = self::newBar(null, $rowGroup->gantt);
        $noBar->showBar         = false;
        $rowSubGroup->bar       = $noBar;
        $rowSubGroup->calculateTotals();
        return $rowSubGroup;
    }

    private static function newRow($data, RowSubGroup $rowSubGroup)
    {
        $gantt = $rowSubGroup->rowGroup->gantt;
        $row = new Row;
        $row->subGroup      = $rowSubGroup;
        $row->rowLabel      = $data['rowLabel'];
        $row->tasks         = $data['tasks'];
        $row->cssClasses    = explode(' ', $data['cssClass']);
        $row->setCols($gantt->columns, $data['start'], $data['end'], $gantt->firstCol, $gantt->lastCol);
        $row->bar           = self::newBar($row, $gantt);
        $row->bar->text     = DatesHelper::rangeLabel(strtotime($data['start']), strtotime($data['end']));
        return $row;
    }

    private static function startCol($columns, $isoDate, $defaultCol)
    {
        return isset($columns[$isoDate])
            ? $columns[$isoDate]
            : $defaultCol;
    }

    private static function newColumn($iso)
    {
        $col = new Column;
        $col->timestamp = strtotime($iso);
        return $col;
    }
}