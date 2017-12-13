# gantt
Simple Gantt chart

instantiate
-----------
``` php
$groupedCols = \Gpor\Gantt\DatesHelper::ganttColGroups(
    ($_GET['start'] ?? time()),
    ($_GET['end'] ?? null)
);
$gantt = \Gpor\Gantt\Factory::newGantt($groupedCols, $rows, ['isMobile' => $agent->isMobile()]);

```

Config
------
``` php
# custom bar text
$gantt->barTextFunction = function(\Gpor\Gantt\Bar $bar) {
    return date('j M Y', strtotime($bar->start_date)) . ' - ' . date('j M Y', strtotime($bar->end_date));
};

# disable bar text
$gantt->barTitleAttrs = false;
$gantt->barTextShow = false;

```

if you disable barTitleAttrs, the bar will have a data-text atrribute instead
