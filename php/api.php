<?php

  require "../dbconnect.php";

  session_start();

  try {
    if (!isset($_GET["type"])){
      throw new Exception("不正なアクセスです!");
    }

    switch ($_GET["type"]) {
      case "user":
        $stmt = exeSQL("SELECT name, attend FROM user_table");
        break;
      case "color":
        $stmt = exeSQL("SELECT * FROM date_color_table ORDER BY date DESC");
        break;
      case "count":
        $stmt = exeSQL("SELECT * FROM date_count_table ORDER BY date DESC");
        break;
      case "color_and_count":
        $stmt = exeSQL("SELECT * FROM date_color_table INNER JOIN date_count_table ON date_color_table.date = date_count_table.date ORDER BY date_color_table.date DESC");
        break;
      default:
        throw new RuntimeException("invalid value...");
        break;
    }

    $all_data = array();

    while($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
        $all_data[] = $rec;
    }
    //JSON_UNESCAPED_UNICODEは文字化け対策
    header('Content-type:application/json; charset=utf8');

    echo json_encode($all_data, JSON_UNESCAPED_UNICODE);

  } catch (Exception $e) {
    echo $e->getMessage();
  }
?>