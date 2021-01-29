<?php


if ($_FILES["file"]["error"] < 1) {
    //不存在文件夹就新建
    $wenjianjia = "updata/";
    $name1 = "file";
    if (!file_exists($wenjianjia)) {
        mkdir($wenjianjia);
    }
    $wenjianjiatime = $wenjianjia . date('y-m-d', time());
    if (!file_exists($wenjianjiatime)) {
        mkdir($wenjianjiatime);
    }
    //为了避免相同覆盖
    // $namee = date('h-i-s') . "-" . $_FILES[$name1]["name"]; //获取到上传文件的名称（文件名.后缀名）
    $namee = date('h-i-s') . "." ."jpg"; 
    //新建指定文件夹地址+上内容名和后缀名
    $name = $wenjianjia . date('y-m-d', time()) . "/" . $namee;
    //把上传的文件上传到新建指定文件夹中
    //move_uploaded_file(需要上传的文件内容和地址,上传到那个地方);
    $result = move_uploaded_file($_FILES[$name1]["tmp_name"], $name); //
    //存储图片地址
    $tc_information = $name;
    $tc_information = json_encode($tc_information, JSON_UNESCAPED_SLASHES);
    
    
	
    
    // print("ss");
    // print($name);
    // print($_FILES[$name1]["name"]);
} else {
    $tc_information = "图片上传出错了";
    $tc_information = json_encode($tc_information);
    return $tc_information;
}

    // print($namee);
