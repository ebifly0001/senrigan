<?php
    require "../dbconnect.php";

    session_start();

    // 全ユーザーの名前・出席情報を全て取得
    $stmt = exeSQL("SELECT name, attend FROM user_table WHERE 1");

    // 全てのデータベースのデータを格納する配列を定義
    $all_data = array();
    
    //カラム名で配列に添字をつけた配列（連想配列）を返す
    while($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
        $all_data[] = $rec;
    }
    
    //JSON_UNESCAPED_UNICODEは文字化け対策
    header('Content-type:application/json; charset=utf8');
    // JSON形式でレスポンスを返す
    echo json_encode($all_data, JSON_UNESCAPED_UNICODE);
    
?>