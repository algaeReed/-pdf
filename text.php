
<?php
// 存储数据的文件
function hit(){
    $filename = 'text.txt';       
    header('Content-type: text/html; charset=utf-8');
    
    if(!file_exists($filename)) {
        die($filename . ' 数据文件不存在');
    }
    $data = file_get_contents($filename);
    $data = explode(PHP_EOL, $data);
    $result = $data[array_rand($data)];
    $result = str_replace(array("\r","\n","\r\n"), '', $result);
    return "$result";   
}

$h = hit();

// echo "#遇见美好#";
// echo "</br>";
// echo $h; 
?>