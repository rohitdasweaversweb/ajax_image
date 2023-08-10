<?php

echo 'Deleted';


    include('config/db.php');
    $id=$_POST['id'];

    $sql="SELECT * FROM  `tbl_ajax_image` WHERE `id`='$id'";
    $rs=$con->query($sql);
    while($row=$rs->fetch_assoc()){
        $del_img=$row['image'];
        unlink('picture/'.$del_img);
    }

    $del="DELETE FROM `tbl_ajax_image` WHERE `id`='$id'";
    $con->query($del);

    
?>


