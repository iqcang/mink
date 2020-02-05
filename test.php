<?php

$text = $_POST['text'];  
$minute = $_POST['minute'];

echo json_encode(array('status' => 200, 'message' => $text, 'minute' => $minute));
?>