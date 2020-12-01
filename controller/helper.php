<?php
    require_once "connection.php";
    
class Helper {

    public function insert($table_name,$values)
    {
        global $mysqli;
        $query = "INSERT INTO ".$table_name." (`";
        $query .= implode("`,`", array_keys($values)) . '`) VALUES (';
        $query .= "'" . implode("','", array_values($values)) . "')";        
        return mysqli_query($mysqli, $query);
    }

    public function search($value)
    {
        global $mysqli;
        $query = "SELECT * FROM `tbl_queue` WHERE `plate_no`='{$value}' AND is_completed = 0;";
        $result = mysqli_query($mysqli, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function mark_complete($value)
    {
        global $mysqli;
        $query = "UPDATE tbl_queue SET is_completed = 1 WHERE id = {$value}";        
        return mysqli_query($mysqli, $query);
    }

    public function in_progress()
    {
        global $mysqli;
        $query = "SELECT * FROM tbl_queue WHERE is_completed = 0 LIMIT 5";
        $result = mysqli_query($mysqli, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function queue()
    {
        global $mysqli;
        $query = "SELECT * FROM tbl_queue WHERE is_completed = 0 LIMIT 5,10";
        $result = mysqli_query($mysqli, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function dashboard()
    {
        global $mysqli;
        $query = '
                SELECT
                    COUNT( id ) total,
                    SUM(case when target_color="red" then 1 else 0 end) as red,
                    SUM(case when target_color="blue" then 1 else 0 end) as blue,
                    SUM(case when target_color="green" then 1 else 0 end) as green
                FROM
                    tbl_queue 
                WHERE
                    is_completed = 1
        ';
        $result = mysqli_query($mysqli, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}