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