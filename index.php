<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <h3 class="text-center">Ajax Crud With Image</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form enctype="multipart/form-data" id="frm">
                    <p>Name</p>
                    <p><input type="text" class="form-control-sm" name="sname" id="sname"></p>
                    <p>email</p>
                    <p><input type="text" class="form-control-sm" name="email" id="email"></p>
                    <p>pic</p>
                    <p><input type="file" class="form-control-sm" name="simg" id="simg"></p>
                    <p><input type="button" value="Submit" onclick="addData()"></p>
                </form>
          </div>

          <div class="col-md-6">
                <!-- <h4 class="md-5">user Details</h4> -->
                <table class="table" >
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                       
                        <?php
                            include("config/db.php");
                            $sql="SELECT * FROM  tbl_ajax_image";
                            $rs=$con->query($sql);
                            while($row=$rs->fetch_assoc()){
                        ?>
                    <tbody id="tbl">
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><img src="picture/<?php echo $row['image'];?>" style="width: 100px;"></td>
                            <td>
                                <button class="btn btn-warning" id="edit">edit</button>
                                <button name="del_btn" class="btn btn-danger" id="del" onclick="delRecord($did='<?php echo $row['id'] ?>')">Delete</button>    
                            </td>
                        </tr>
                    </tbody>
                    <?php }?> 
                 </table>
          </div>
        </div>   
    </div>
</body>
<script>
    // $(document).ready(function(){
    // function getData(){
    //     $.ajax({
    //         url:'listing.php',
    //         type:'GET',
    //         dataType:'html',
    //         success:function(data){
    //             $('#tbl').html(data)
    //         }
    //     });
    // }
    // getData();


    function addData(){
        var fd=new FormData();
        var img=document.getElementById("simg").files[0];
        fd.append("simg",img);
        fd.append("sname",$("#sname").val());
        fd.append("email",$("#email").val());


        $.ajax({
            url:"insert.php",
            type:"POST",
            data:fd,
            contentType:false,
            processData:false,
            success:function(data){
                // alert(data);return;  
                // $("#tbl").html(data);
                // document.getElementById("frm").reset();
                $("#frm")[0].reset();
                window.location.reload();
            }
        });
    }


    function delRecord(){
        if(confirm('Are you sure?')){
        var fd=new FormData();
        fd.append("id",id);
        $.ajax({
        url:"del.php",
        type:'GET',
        data:fd,
        contentType:false,
        processData:false,
        success:function(data){
                alert(data);return;
                $("#tbl").html(data);
                // getData();
            }
        });
      }
    }
    // delRecord();
    // });
</script>
</html>