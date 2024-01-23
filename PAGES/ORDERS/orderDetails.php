<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2 style="color:#0dcaf0;">Order&nbsp;Details</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-sm btn-secondary m-1"
            onclick="window.location.href='sideDishes.php'">Products&nbsp;with&nbsp;Sides&nbsp;Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success m-1"
            onclick="window.location.href='Price.php'">Price</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-warning text-white m-1" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Create&nbsp;Product</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-info " onclick="window.location.href='order.php'">Back</button>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <strong>Products&nbsp;Types</strong>
    </div>
    <div class="card-body" id="product_type">

    </div>
</div>
<div class="card">
    <div class="card-header">
        <strong>Products&nbsp;Categories</strong>
    </div>
    <div class="card-body" id="product_category">

    </div>
</div>
<?php
$o_ref = $_GET['o_ref'];
$orderDao = new OrdersDao();
$orderObj = new Orders();
$orderObj->setORef($o_ref);
$oInfo = $orderDao->selectOrderById($orderObj);
// print_r($oInfo);


?>
<div class="oRefInput">
    <input type="text" value="<?=$o_ref?>" id="oRefInput" style="display:none;">
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="row overflow-auto" id="productDetails">
                    <!-- PRODUCTS GOES HERE -->

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Payment&nbsp;Note</strong>
                    </div>

                    <div class="card-body">
                        <div class="title_o m-1 p-1 row">
                            <span>GREEN-GARDEN-BAR</span>
                        </div>
                        <div class="address_o  m-1 row">
                            <div class="col-5 justify-content-start">
                                <p>Tin : 103477797</p>
                                <p>Tel : (+250) 788 322 151</p>
                            </div>
                            <div class="col-7  justify-content-end">
                                <p>P.O Box: 7547 Kigali- Rwanda</p>
                                <!-- <p>Address : Kigali-Rwanda</p> -->
                                <p>Website : www.xxxx.com</p>
                            </div>
                        </div>
                        <div class="address_info m-1  row">
                            <div class="col-6 justify-content-start">
                                <p>Ref : <?=$oInfo['O_REF']?></p>
                                <p>Waiter : <?=$oInfo['LASTNAME']." ".$oInfo['FIRSTNAME']?></p>
                            </div>
                            <div class="col-6 justify-content-end">
                                <p style="font-size:10px;">Session : <?=$oInfo['S_REF']?></p>
                                <p>Date: <?=$oInfo['O_DATE']?> </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- <caption>List of Registered Products in Stock</caption> -->
                            <table class="table table-striped table-sm table-hover">
                                <thead>
                                    <tr style='background:#e3e2e2; color: black;font-weight: bold;'>
                                        <th scope="col" style="text-align: center;">#</th>
                                        <th scope="col" style="text-align: center;">Item</th>
                                        <th scope="col" style="text-align: center;">Unity</th>
                                        <th scope="col" style="text-align: center;">Qty</th>
                                        <th scope="col" style="text-align: center;">U/P</th>
                                        <th scope="col" style="text-align: center;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    
                                    
                                    
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">1</td>
                                        <td style="text-align: center;">MUTZING 65CL</td>
                                        <td style="text-align: center;">Btl</td>
                                        <td style="text-align: center;">4</td>
                                        <td style="text-align: center;">1300Frw</td>
                                        <td style="text-align: center;">5200Frw</td>
                                    </tr>



                                    <tr>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">PRIMUS 65CL</td>
                                        <td style="text-align: center;">Btl</td>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">1000Frw</td>
                                        <td style="text-align: center;">2000Frw</td>
                                    </tr>



                                    <tr style='background:darkred; color: white;font-weight: bold;'>
                                        <td colspan="5" style="text-align: left;">TOTAL:</td>
                                        <td style="text-align: center;">7200Frw</td>
                                    </tr>


                                </tbody>


                            </table>
                            <div class="p-1">
                                <button type="submit" name="printOrder" class="btn btn-info "
                                    onclick="window.location.href='../../../PDF/pdf_order.php?ref=O-0170'">Print</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="edit_modal hide">



</div>


<?php require_once '../../INCLUDES/footer.php' ?>