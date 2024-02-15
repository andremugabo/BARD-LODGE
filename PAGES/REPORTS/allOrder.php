<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->
<?php
$byPaymentMode =" ";
$byEId = "";


if(isset($_POST['viewSales'])){
    $paymentMode = $_POST['paymentMode'];
    $e_id = $_POST['e_id'];
    if(!empty($paymentMode) && !empty($e_id)){
      $byEId = " AND orders.e_id = '".$e_id."'";  
      $byPaymentMode = "AND  orders.payment_mode = '".$paymentMode."'".$byEId;
      
    }else{
        header("refresh: 3"); 
    }
}


?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2>My&nbsp;Daily&nbsp;Order</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-sm btn-secondary m-1"
            onclick="window.location.href='sideDishes.php'">Products&nbsp;with&nbsp;Sides&nbsp;Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success m-1"
            onclick="window.location.href='Price.php'">Price</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-info text-white m-1"
            onclick="window.location.href='dailyReport.php'">Daily&nbsp;Report&nbsp;Summary</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-secondary text-white m-1"
            onclick="window.location.href='allOrder.php'">All&nbsp;Orders</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-primary text-white m-1"
            onclick="window.location.href='AllSales.php'">Sales</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='dailyReport.php'">Back</button>
    </div>
</div>

<div class="title_bar btn-info d-flex">
    <h2>My&nbsp;Daily&nbsp;Order</h2>
</div>
<div class=" m-2 p-2 " style="background: #0dcaf0;">
    <form class="row gx-3 gy-2 align-items-center mb-4 mt-2" action="" method="POST">
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeSelect">Preference</label>
            <select class="form-select" name="paymentMode" id="specificSizeSelect">
                <option selected value="">Payment&nbsp;Mode</option>
                <option value="CASH">CASH</option>
                <option value="MOMO">MOMO</option>
                <option value="CREDIT CARD">CREDIT&nbsp;CARD</option>
                <option value="DEBT">DEBT(DETTE)</option>

            </select>
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeSelect">Order&nbsp;Placed&nbsp;By:</label>
            <select class="form-select" name="e_id" id="specificSizeSelect">
                <option selected disabled value="">Served&nbsp;By:</option>
                <?php
                $orderDao = new OrdersDao();
                $orderObj = new Orders();
                $orderObj->setSId($sessionInfo[0]['S_ID']);
                $getEmployeeBYOrder = $orderDao->selectEmployee($orderObj,$byPaymentMode);
                // print_r($getEmployeeBYOrder);
               if($getEmployeeBYOrder!=null):
                foreach($getEmployeeBYOrder as $emp){
                    echo "<option value=".$emp['E_ID'].">".$emp['FIRSTNAME']."</option>";
                }
               endif;
                
                ?>
            </select>
        </div>
        <!-- <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeSelect">Preference</label>
            <select class="form-select" name="e_id" id="specificSizeSelect">
                <option selected value="">All&nbsp;Saller</option>
                
            </select>
        </div> -->

        <div class="col-auto">
            <button type="submit" name="viewSales" class="btn btn-warning">View&nbsp;Payment&nbsp;Mode</button>
        </div>
    </form>
</div>

<div class="period_diplay"> SALES REPORT ON <?= date("Y/m/d") ?> </div>
<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">List of Registered Paid Daily Orders</strong>
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
                        <th scope="col" style="text-align: center;">Payment&nbsp;Mode</th>
                        <th scope="col" style="text-align: center;">Total&nbsp;Amount</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $orderDao = new OrdersDao();
                $orderObj = new Orders();
                $orderObj->setSId($sessionInfo[0]['S_ID']);
                $selectProduct =$orderDao->selectPaymentModeAll($orderObj,$byPaymentMode);
                $num = 0;
                $sum = 0;
                if ($selectProduct):
                foreach ($selectProduct as $item) {  $num++;
                    $sum+=$item['O_AMOUNT'];            
                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <!-- <td style="text-align: center;">subSession/15-01-2024/0007</td> -->
                        <td style="text-align: center;"><?=$item['O_REF']?></td>
                        <td style="text-align: center;"><?=$item['FIRSTNAME']." ".$item['LASTNAME']?></td>
                        <td style="text-align: center;"><?=$item['O_DATE']?></td>
                        <td style="text-align: center;"><?=$item['O_PAYMENT']?></td>
                        <td style="text-align: center;"><?=$item['payment_mode']?></td>
                        <td style="text-align: center;"><?=$item['O_AMOUNT']?></td>
                        <td style="text-align: center;">

                            <button type="button" class="btn btn-info btn-sm  mt-1"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=<?=$item['O_REF']?>'">Order&nbsp;Details</button>

                        </td>
                    </tr>











                    <?php } endif; ?>

                    <tr style='background:darkred; color: white;font-weight: bold;'>
                        <td colspan="6" style="text-align: left;">TOTAL:</td>
                        <td style="text-align: center;"><?=$sum?></td>
                        <td style="text-align: center;"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>







<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>