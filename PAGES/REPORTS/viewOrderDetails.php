<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2 style="color:#0dcaf0;">Order&nbsp;Details&nbsp;View</h2>
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
        <button type="button" class="btn btn-sm btn-info " onclick="window.location.href='myOrder.php'">Back</button>
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


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Kitchen order form</strong>
                    </div>
                    <div class="card-body">
                        <div class="title_o m-1 p-1 row">
                            <span>GREEN-WORLD-CORNER</span>
                        </div>
                        <div class="title_o m-1 p-1 row">
                            <span>KITCHEN ORDER FORM</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-hover">
                                <thead>
                                    <tr
                                        style='background:#e3e2e2; color: black;font-weight: bold;border-bottom:2px solid black;'>
                                        <th scope="col" style="text-align: center;">Ref:</th>
                                        <th colspan="4" scope="col" style="text-align: center;"><?=$oInfo['O_REF']?>
                                        </th>
                                    </tr>
                                    <tr
                                        style='background:#e3e2e2; color: black;font-weight: bold;border-bottom:2px solid black;'>
                                        <th scope="col" style="text-align: center;">Served&nbsp;By:&nbsp;</th>
                                        <th colspan="4" scope="col" style="text-align: center;">
                                            <?=$oInfo['LASTNAME']." ".$oInfo['FIRSTNAME']?></th>
                                    </tr>
                                    <tr style='background:#e3e2e2; color: black;font-weight: bold;'>
                                        <th scope="col" style="text-align: center;">#</th>
                                        <th scope="col" style="text-align: center;">Item</th>
                                        <th scope="col" style="text-align: center;">Qty</th>
                                        <th scope="col" style="text-align: center;">U/P</th>
                                        <th scope="col" style="text-align: center;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       $orderDetailsDao = new OrderDetailsDao();
                                       $orderDetails = new OrderDetails();
                                       $orderDaoObj = new OrdersDao();
                                       $orderObj = new Orders;
                                       $orderObj->setORef($_GET['o_ref']);
                                       $orderInfo = $orderDaoObj->selectOrderById($orderObj);
                                    //    print_r($orderInfo);
                                    //    echo$orderInfo['O_ID'];
                                    //    echo $_GET['o_ref'];
                                       $orderDetails->setOId($orderInfo['O_ID']);
                                       $selectedOrder = $orderDetailsDao->selectOrderDetailsByOIdAndByFood($orderDetails);
                                       $num = 0;
                                       $total = 0;
                                       $sum = 0;
                                       if ($selectedOrder != null):
                                        // print_r($selectedOrder);
                                       foreach ($selectedOrder as $item) {  $num++;
                                       $total = $item['S_PRICE']*$item['P_QTY'];
                                       $sum += $total; 
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?=$num?></td>
                                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                                        <td style="text-align: center;"><?=$item['P_QTY']?></td>
                                        <td style="text-align: center;"><?=$item['S_PRICE']."Frw"?></td>
                                        <td style="text-align: center;"><?=$total."Frw"?></td>
                                    </tr>



                                    <?php } ?>
                                    <?php endif; ?>
                                    <tr style='background:darkred; color: white;font-weight: bold;'>
                                        <td colspan="4" style="text-align: left;">TOTAL:</td>
                                        <td style="text-align: center;"><?=$sum."Frw"?></td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="p-1">
                                <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" || $employee_role == "BARMAN"): ?>
                                <a type="submit" target="_blank" name="PlaceOrder" class="btn btn-warning "
                                    href='../PDF/pdf_korder.php?o_ref=<?=$_GET['o_ref']?>'>Print</a>
                                <?php endif;?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Payment&nbsp;Note</strong>
                    </div>

                    <div class="card-body">
                        <div class="title_o m-1 p-1 row">
                            <span>GREEN-WORLD-CORNER</span>
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
                                <p>Served&nbsp;By:&nbsp;<?=$oInfo['LASTNAME']." ".$oInfo['FIRSTNAME']?></p>
                            </div>
                            <div class=" col-6 justify-content-end">
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

                                    $orderDetailsDao = new OrderDetailsDao();
                                    $orderDetails = new OrderDetails();
                                    $orderDaoObj = new OrdersDao();
                                    $orderObj = new Orders;
                                    $orderObj->setORef($_GET['o_ref']);
                                    $orderInfo = $orderDaoObj->selectOrderById($orderObj);
                                    // echo$orderInfo['O_ID'];
                                    $orderDetails->setOId($orderInfo['O_ID']);
                                    $selectedOrder = $orderDetailsDao->selectOrderDetailsByOId($orderDetails);
                                    $num = 0;
                                    $total = 0;
                                    $sum = 0;
                                    if ($selectedOrder != null):
                                    foreach ($selectedOrder as $item) {  $num++;
                                    $total = $item['S_PRICE']*$item['P_QTY'];
                                    $sum += $total;    
                                    
                                    
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?=$num?></td>
                                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                                        <td style="text-align: center;"><?=$item['UNITY_NAME']?></td>
                                        <td style="text-align: center;"><?=$item['P_QTY']?></td>
                                        <td style="text-align: center;"><?=$item['S_PRICE']?></td>
                                        <td style="text-align: center;"><?=$total?></td>
                                    </tr>

                                    <?php 
                                     }
                                     endif;
                                     ?>





                                    <tr style='background:darkred; color: white;font-weight: bold;'>
                                        <td colspan="5" style="text-align: left;">TOTAL:</td>
                                        <td style="text-align: center;"><?=$sum?></td>
                                    </tr>


                                </tbody>


                            </table>
                            <div class="p-1">
                                <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" || $employee_role == "BARMAN"): ?>
                                <a type="submit" target="_blank" name="printOrder" class="btn btn-info "
                                    href='../PDF/pdf_order.php?o_ref=<?=$_GET['o_ref']?>'>Print</a>
                                <?php endif;?>

                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php require_once '../../INCLUDES/footer.php' ?>