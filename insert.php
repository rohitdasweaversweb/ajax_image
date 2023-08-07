<?php
include("config/db.php");
$n=$_POST['sname'];
$e=$_POST['email'];

$fn=time().$_FILES['simg']['name'];
$ext=explode(".",$fn);
$cn=count($ext);
if($ext[$cn-1]=='jpg' ||$ext[$cn-1]=='jpeg' ||$ext[$cn-1]=='png' ){
$tmp=$_FILES['simg']['tmp_name'];
move_uploaded_file($tmp,'picture/'.$fn);
$ins="INSERT INTO tbl_ajax_image SET name='$n',email='$e',image='$fn' ";
$con->query($ins);
}
else{
    echo"File type mismatched";
}

?>
