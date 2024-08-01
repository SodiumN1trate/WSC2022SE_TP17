<?php

$file = 'data.json';
$file_content = json_decode(file_get_contents($file));
$page = $_GET['page'];
$result = [];

for($i = $page * 10 - 10; $i < $page * 10; $i++) {
    $result[] = $file_content[$i];
}

echo json_encode($result);
