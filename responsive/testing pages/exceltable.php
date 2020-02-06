<?php  
 //excel.php  
 header('Content-Type: application/vnd.ms-excel');  
 header('Content-disposition: attachment; filename='.rand().'.xls');  
 echo $_POST["data"];  
 ?>  

Script Code:
<script>  
 $(document).ready(function(){  
      $('#create_excel').click(function(){  
           var excel_data = $('#employee_table').html();  
           var page = "excel.php?data=" + excel_data;  
           window.location = page;  
      });  
 });  
 </script>  
<button name="create_excel" id="create_excel" class='btn c-theme-btn c-btn-uppercase btn-xs  c-btn-square c-font-sm'>Export to Excel</button>

                    </div>
                    <div class="c-content-panel">
                      <div class="c-body">
                            <div class="row">
                                <div class="col-md-12" id="employee_table">
                                    <table class="table table-bordered">

                                        <?php
                                       echo " <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Store ာာာName</th>
                                                <th>Zip</th>
                                                <th>City</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>Tv Varient</th>
                                                <th>Total</th>
                                                <th>Delivery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                              <tbody>";
                                               while($row = mysqli_fetch_array($result))
                                          {
                                             $id = $row['id'];

                                           echo"<tr id='row_$id'>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['rdate'] . "</td>";
                                                echo "<td>" . $row['rname'] . "</td>";
                                                echo "<td>" . $row['rstore'] . "</td>";
                                                echo "<td>" . $row['rzip'] . "</td>";
                                                echo "<td>" . $row['rcity'] . "</td>";
                                                echo "<td>" . $row['raddress'] . "</td>";
                                                echo "<td>" . $row['rphone'] . "</td>";
                                                echo "<td>" . $row['rtv_varient'] . "</td>";
                                                echo"<td>" . $row['ramount'] . "</td>";
                                                echo"<td>" . $row['rdelivery'] . "</td>";
                                                echo "<input type='hidden' id='row_id' value='$id'/>";

                                                echo "<td> <button  id='test' class='btn c-theme-btn c-btn-uppercase btn-xs  c-btn-square c-font-sm'>Delete</button> </td>";

                                                  echo"</tr>";


                                                 }
                                                 ?>
                                        </tbody>