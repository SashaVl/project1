<?php

class db
{
    const host = 'localhost';
    const user = 'root';
    const pass = '';
    const db = 'splynx';

    public function dbConnect()
    {
        return mysqli_connect($this::host, $this::user, $this::pass, $this::db);
    }

    public function yearList($link)
    {
        $n = 0;
        $q = "SELECT YEAR(start_date) AS year FROM statistics GROUP BY year";
        $res = mysqli_query($link, $q);

        while ($result[$n] = mysqli_fetch_assoc($res)) {
            $n++;
        }
        unset($result[$n]);
        return $result;
    }

    public function statisticOnYear($link, $year)
    {
        $n = 0;
        $q = "SELECT tariffs_internet.title AS tariff,
        partners.name AS partner,
        SUM(statistics.in_bytes) AS in_,
        SUM(statistics.out_bytes) AS out_,
        tariffs_internet.id AS tId,
        partners.id AS pId

        FROM partners INNER JOIN statistics ON partners.id=statistics.partner_id
        INNER JOIN tariffs_internet ON tariffs_internet.id=statistics.tariff_id
        WHERE YEAR(statistics.start_date) = " . $year . "
        GROUP BY tId, pId";
        $res = mysqli_query($link, $q);

        while ($result[$n] = mysqli_fetch_assoc($res)) {
            $n++;
        }
        unset($result[$n]);
        return $result;
    }

    public function partnerList($link)
    {
        $n = 0;
        $q = "SELECT id, name FROM partners ";
        $res = mysqli_query($link, $q);

        while ($result[$n] = mysqli_fetch_assoc($res)) {
            $n++;
        }
        unset($result[$n]);
        return $result;
    }

    public function tariffList($link)
    {
        $n = 0;
        $q = "SELECT id, title FROM tariffs_internet ";
        $res = mysqli_query($link, $q);

        while ($result[$n] = mysqli_fetch_assoc($res)) {
            $n++;
        }
        unset($result[$n]);
        return $result;
    }
}