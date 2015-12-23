       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Products</h1>
                </div>
                <!-- /.col-lg-12 -->
             </div>
            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables

                            <a href="add-product.php" class="btn btn-info" style="margin-left: 65%;">Add New Product</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">#sl</th>
                                            <th style="text-align:center;">Product Name</th>
                                            <th style="text-align:center;">Bar Code</th>
                                            <th style="text-align:center;">Quantity</th>
                                            <th style="text-align:center;">Buying Price</th>
                                            <th style="text-align:center;">Selling Price</th>
                                            <th style="text-align:center;">Added By</th>
                                            <th style="text-align:center;">Added on</th>
                                            <th style="text-align:center;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  
                                        mysql_connect("localhost", "root", "root");
                                        mysql_select_db("inventory");
                                        
                                        $qry = getAllProducts();

                                        $i = 1;

                                        while($data = mysql_fetch_object( $qry )){
                                    ?>

                                        <tr class="odd gradeX">
                                            <td> <?php echo $i; ?> </td>
                                           
                                             <td> <a href="edit-product.php?pId=<?php echo $data->pId; ?> "><?php echo $data->pName; ?></a> </td>
                                            <td> <?php echo $data->pBarCode; ?> </td>
                                            <td> <?php 
                                                if($data->bQuantity == 0)
                                                {
                                                 echo ($data->pQuantity);
                                                }else
                                                
                                                {
                                                 echo $data->bQuantity;
                                                }

                                             ?> </td>
                                            <td> <?php echo '$'.$data->pBuyingPrice; ?> </td>
                                            <td> <?php echo '$'.$data->pSellingPrice; ?> </td>
                                            <td class="center"> <?php echo getUsernameByUserId($data->pAddedBy); ?> </td>
                                            
                                            <td class="center"> <?php 
                                                   
                                                


                                            $databaseDate = new Carbon\Carbon( $data->pEntryDate );

                                            //echo $databaseDate->diffForHumans();

                                            echo $databaseDate->diffForHumans();


                                                ?> 
                                            </td>
                                            <td class="center" data-pId="<?php echo $data->pId; ?>"> <button class="del-cata btn btn-danger" data-did="<?php echo $data->pId; ?>">delete</button>  </td>


                                        </tr>
                                        
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>

                                


                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h1>Do you Want to Delete this product?</h1>
                                        </div>
                                        <div class="modal-footer">
                                           <!-- <button id="del-confirm"></button> -->
                                            <input id="del-confirm" type="button" name="yes" value="Yes" class="btn btn-primary" />
                                            <input type="button" name="no" value="No" class="btn btn-danger" />
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                             <script type="text/javascript">
                                $(function(){
                                    $(".del-cata").click(function(){
                                        //alert($(this).data("did"));
                                        var row = $(this);
                                        var id = $(this).data("did");                                        
                                        if(confirm("Are you sure?")){
                                            $.ajax({
                                                url: "body/delete-product.php",
                                                type: "post",
                                                data: {dId:id}
                                            }).done(function(msg){
                                                row.closest("tr").remove();

                                            });
                                        }
                                    });
                                });

                                </script>  
                            </div>
                            
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
         



            <!-- /.row -->
        </div>