<?php
    include('config/db.php');
    $id=$_GET['id'];
    $del="DELETE FROM tbl_ajax_image WHERE id='$id'";
    $con->query($del);
?>


