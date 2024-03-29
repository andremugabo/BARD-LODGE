<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2>Individual&nbsp;Sales&nbsp;Report</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-sm btn-secondary m-1"
            onclick="window.location.href='sideDishes.php'">Products&nbsp;with&nbsp;Sides&nbsp;Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success m-1"
            onclick="window.location.href='Price.php'">Price</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-success text-white m-1"
            onclick="window.location.href='individualReport.php'">Report&nbsp;Summary</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-primary text-white m-1"
            onclick="window.location.href='order_with_debt.php'">Order&nbsp;with&nbsp;Debt</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-info text-white m-1"
            onclick="window.location.href='myOrder.php'">My&nbsp;Orders</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-warning text-white m-1"
            onclick="window.location.href='individualSales.php'">Sales</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger " onclick="window.location.href='report.php'">Back</button>
    </div>
</div>
<div class="title_bar btn-success d-flex">
    <h2>Report&nbsp;Summary</h2>
</div>
<div class="content mt-3 d-flex flex-wrap ">

    <div class=" col-lg-2 m-3 individual_card">
        <div class="card text-white bg-info">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count display_count">
                        <?php
                        $orderDao = new OrdersDao();
                        $orderObj = new Orders();
                        $s_id = $sessionInfo[0]['S_ID'];
                        $orderObj->setEId($employee_eid );
                        $orderObj->setSId($s_id);
                        $countItem = $orderDao->countOrdersByEIdAndSIdOrder($orderObj);
                        if($countItem == 0)
                        {
                            echo "NO ORDER YET";
                        }
                        else
                        {
                            echo $countItem." ORDER(S) ";
                        }
                    
                    ?>
                    </span>
                </h4>
                <p class="display_service">Daily&nbsp;Orders</p>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class=" col-lg-2 m-3 individual_card">
        <div class="card text-white bg-warning">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count display_count">
                        <?php
                        $orderDao = new OrdersDao();
                        $orderObj = new Orders();
                        $s_id = $sessionInfo[0]['S_ID'];
                        $orderObj->setEId($employee_eid );
                        $orderObj->setSId($s_id);
                        $countItem = $orderDao->countOrdersByEIdAndSIdUnPaid($orderObj);
                        if($countItem == 0)
                        {
                            echo "NO ORDER YET";
                        }
                        else
                        {
                            echo $countItem." ORDER(S) ";
                        }
                    
                    ?>
                    </span>
                </h4>
                <p class="display_service">Unpaid&nbsp;Orders</p>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class=" col-lg-2 m-3 individual_card">
        <div class="card text-white bg-danger">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count display_count">
                        <?php
                        $orderDao = new OrdersDao();
                        $orderObj = new Orders();
                        $s_id = $sessionInfo[0]['S_ID'];
                        $orderObj->setEId($employee_eid );
                        $orderObj->setSId($s_id);
                        $countItem = $orderDao->countOrdersByEIdAndSIdPaid($orderObj);
                        if($countItem == 0)
                        {
                            echo "NO ORDER YET";
                        }
                        else
                        {
                            echo $countItem." ORDER(S) ";
                        }
                    
                    ?>
                    </span>
                </h4>
                <p class="display_service">Paid&nbsp;Orders</p>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class=" col-lg-2 m-3 individual_card">
        <div class="card text-white bg-secondary">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count display_count">
                        <?php
                        $orderDao = new OrdersDao();
                        $orderObj = new Orders();
                        $s_id = $sessionInfo[0]['S_ID'];
                        $orderObj->setEId($employee_eid );
                        $orderObj->setSId($s_id);
                        $countItem = $orderDao->countOrdersByEIdAndSIdCredits($orderObj);
                        if($countItem == 0)
                        {
                            echo "NO ORDER YET";
                        }
                        else
                        {
                            echo $countItem." ORDER(S) ";
                        }
                    
                    ?>
                    </span>
                </h4>
                <p class="display_service">Credit&nbsp;Orders</p>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class=" col-lg-2 m-3 individual_card">
        <div class="card text-white bg-success">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count display_count">
                        <?php
                        $orderDao = new OrdersDao();
                        $orderObj = new Orders();
                        $s_id = $sessionInfo[0]['S_ID'];
                        $orderObj->setEId($employee_eid );
                        $countItem = $orderDao->countOrdersByEIdAllOrder($orderObj);
                        if($countItem == 0)
                        {
                            echo "NO ORDER YET";
                        }
                        else
                        {
                            echo $countItem." ORDER(S) ";
                        }
                    
                    ?>
                    </span>
                </h4>
                <p class="display_service">All&nbsp;Orders</p>
            </div>
        </div>
    </div>
    <!--/.col-->



</div>
<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">List of Registered Daily Orders</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <!-- <th scope="col" style="text-align: center;">Subsession&nbsp;Entry&nbsp;Point</th> -->
                        <th scope="col" style="text-align: center;">Order&nbsp;Reference</th>
                        <th scope="col" style="text-align: center;">Placed&nbsp;By</th>
                        <th scope="col" style="text-align: center;">Date</th>
                        <th scope="col" style="text-align: center;">Payment&nbsp;Status</th>
                        <th scope="col" style="text-align: center;">Total&nbsp;Amount</th>
                        <!-- <th scope="col" style="text-align: center;">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $orderDao = new OrdersDao();
                $orderObj = new Orders();
                $orderObj->setEId($employee_eid);
                $orderObj->setSId($sessionInfo[0]['S_ID']);
                $selectProduct =$orderDao->selectOrdersByEIdAndSId($orderObj);
                $num = 0;
                if ($selectProduct):
                foreach ($selectProduct as $item) {  $num++;            
                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <!-- <td style="text-align: center;">subSession/15-01-2024/0007</td> -->
                        <td style="text-align: center;"><?=$item['O_REF']?></td>
                        <td style="text-align: center;"><?=$item['FIRSTNAME']." ".$item['LASTNAME']?></td>
                        <td style="text-align: center;"><?=$item['O_DATE']?></td>
                        <td style="text-align: center;"><?=$item['O_PAYMENT']?></td>
                        <td style="text-align: center;"><?=$item['O_AMOUNT']?></td>
                        <!-- <td style="text-align: center;">
                            <?php if($item['O_PAYMENT'] !== "PAID"):?>
                            <button type="button" class="btn btn-success btn-sm mb-1"
                                onclick="window.location.href='orderDetails.php?o_ref=<?=$item['O_REF']?>'">Add&nbsp;Items</button>&nbsp;
                            <?php endif ?>
                            <button type="button" class="btn btn-info btn-sm mb-1"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=<?=$item['O_REF']?>'">Details</button>
                        </td> -->
                    </tr>

                    <?php } endif; ?>
















                </tbody>
            </table>
        </div>
    </div>
</div>






<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>