<?php
if (!empty($_POST)) {
    include 'db.php';
    $db = new db();
    $link = $db->dbConnect();
    $year = $_POST['year'];
    if (!is_numeric($year)) {
        $year = 0;
    }
    $tariffs = $db->tariffList($link);
    $partners = $db->partnerList($link);
    $statistic = $db->statisticOnYear($link, $year);
    $arrayStat = array();
    foreach ($statistic AS $val) {
        if ($arrayStat[$val['pId']][$val['tId']]['in'] === null) {
            $arrayStat[$val['pId']][$val['tId']]['in'] = 0;
        }
        $arrayStat[$val['pId']][$val['tId']]['in'] = $arrayStat[$val['pId']][$val['tId']]['in'] + $val['in_'];
        if ($arrayStat[$val['pId']][$val['tId']]['out'] === null) {
            $arrayStat[$val['pId']][$val['tId']]['out'] = 0;
        }
        $arrayStat[$val['pId']][$val['tId']]['out'] = $arrayStat[$val['pId']][$val['tId']]['out'] + $val['out_'];
    }
    $ans = "<table id='myTable' ><tr style='border-bottom: solid #000000 1px;'>";
    $ans = $ans . "<td rowspan='2'>" . $_POST['year'] . "</td>";
    foreach ($partners AS $val) {
        $ans = $ans . "<td colspan='2' class='bgColor'>" . $val['name'] . "</td>";
    }
    $ans = $ans . "</tr>";
    $ans = $ans . "<tr style='border-top: solid #000000 1px;border-bottom: solid #000000 2px;'>";
    foreach ($partners AS $val) {
        $ans = $ans . "<td >Download (GB)</td><td>Upload (GB)</td>";
    }
    $ans = $ans . "</tr>";
    foreach ($tariffs AS $val) {
        $ans = $ans . "<tr style='border: solid #000000 1px;'><td class='bgColor'>" . $val['title'] . "</td>";
        foreach ($partners AS $val1) {
            if ($arrayStat[$val1['id']][$val['id']]['in'] !== null) {
                $ans = $ans . "<td>" . $arrayStat[$val1['id']][$val['id']]['in'] . "</td>";
            } else {
                $ans = $ans . "<td>-</td>";
            }
            if ($arrayStat[$val1['id']][$val['id']]['out'] !== null) {
                $ans = $ans . "<td>" . $arrayStat[$val1['id']][$val['id']]['out'] . "</td>";
            } else {
                $ans = $ans . "<td>-</td>";
            }

        }
        $ans = $ans . "</tr>";
    }
    $ans = $ans . "</table>";
    echo $ans;

}