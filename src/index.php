<?php
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json, charset=utf-8');
$conn = mysqli_connect('localhost', 'root', '', 'ionic'); 
mysqli_set_charset($conn, 'utf8');
$method = $_SERVER['REQUEST_METHOD'];
$results = [];
if ($method == 'GET') {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = mysqli_query($conn, "SELECT * FROM tutorial WHERE id=$id");
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $results['Status']['success'] = true;
                $results['Status']['code'] = 200;
                $results['Status']['description'] = 'Request Valid';
                $results['Hasil'][] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'published' => $row['published']
                ];
            }
            $json = json_encode($results);
            print_r($json);
        }
        else{
            $results['Status']['code'] = 400;
            $results['Status']['description'] = 'Request Invalid';
        }
    }else{
        $query = mysqli_query($conn, 'SELECT * FROM tutorial');
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $results['Status']['success'] = true;
                $results['Status']['code'] = 200;
                $results['Status']['description'] = 'Request Valid';
                $results['Hasil'][] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'published' => $row['published']
                ];
            }
            $json = json_encode($results);
            print_r($json);
        }
        else{
            $results['Status']['code'] = 400;
            $results['Status']['description'] = 'Request Invalid';
        }
    }
}else{
    $results['Status']['code'] = 404;
}
