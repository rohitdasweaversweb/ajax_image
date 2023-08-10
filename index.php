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
                    <p><input type="button" class="btn btn-primary" value="Submit" onclick="addData()"></p>
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
                                <a class="delete btn btn-danger" id="<?php echo $row['id'];?>">Delete</a>
                               
                               
                                <!-- //edit modal// -->
                                <div class="modal" id="edit<?php echo $row['id'];?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                        <h4 class="modal-title">Modal Heading</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="container">
                                    <form enctype="multipart/form-data" id="frmedit" onsubmit="return editData(this)">
                                    <input type="text" name="id" value="<?php echo $row['id'];?>">
                                        <p>Name</p>
                                        <p><input type="text" class="form-control-sm" name="name" value="<?php echo $row['name'];?>"></p>
                                        <p>email</p>
                                        <p><input type="text" class="form-control-sm" name="email" value="<?php echo $row['email'];?>"></p>
                                        <p>pic</p>
                                        <p><input type="file" class="form-control-sm" name="img">
                                        <img src="picture/<?php echo $row['image'];?>" style="width: 100px;">
                                    <p><input type="submit" value="Edit" class="btn btn-success"></p>
                                    </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
          <!-- //edit modal end// -->

                                <button class="btn btn-warning" id="edit" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id']?>">Update</button>
                            </td>
                        </tr>
                    </tbody>
                    <?php }?> 
                    <!-- <th><td><h5 class="text-center" style="color:green">No Data Found</h5></td></th> -->
                 </table>
          </div>
         
          
        </div>  
    </div>
</body>
<script type="text/javascript">
   


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
                // $("#tbl").html(data);
                $("#frm")[0].reset();
                window.location.reload();
            }
        });
    }

    
        $('.delete').click(function() {
            var did= $(this).attr("id");  
            if(confirm('Are you Sure?')){
                $.ajax({
                    url:"del.php",
                    type:"POST",
                    data:({id:did}),
                    cache: false,
                    success:function(data){
                        $("#tbl"+did).fadeOut("fast");
                        window.location.reload();

                        // console.log(data);

                    }
                });
            }
        });

        function editData(ev){
            var fd=new FormData(ev);
            $.ajax({
                url:"edit.php",
                type:"POST",
                data:fd,
                contentType:false,
                processData:false,
                success:function(data){
                    // window.location.reload();
                    $("body").load("index.php");
                    document.getElementById("frmedit").reset();
                }
            });
        }
</script>
</html>