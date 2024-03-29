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

<div class="title_bar btn-warning d-flex">
    <h2>My&nbsp;Daily&nbsp;Sales</h2>
</div>
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
                        <th scope="col" style="text-align: center;">Product&nbsp;Type</th>
                        <th scope="col" style="text-align: center;">Product</th>
                        <th scope="col" style="text-align: center;">Quantity</th>
                        <th scope="col" style="text-align: center;">Unity</th>
                        <th scope="col" style="text-align: center;">Selling&nbsp;Price </th>
                        <th scope="col" style="text-align: center;">Total&nbsp;Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                // $orderDao = new OrdersDao();
                $orderDetailsDao = new OrderDetailsDao();
                // $orderObj = new Orders();
                $orderDetailsObj = new OrderDetails();
                $orderDetailsObj->setEId($employee_eid);
                $orderDetailsObj->setSId($sessionInfo[0]['S_ID']);
                $selectProduct =$orderDetailsDao->selectUnityByE_id($orderDetailsObj);
                // print_r($selectProduct);
                $num =0;
                $sum =0;
                $total =0;
               if($selectProduct):
                        foreach($selectProduct as $items){$num++;
                            $orderDetailsObj->setPId($items['p_id']);
                            $orderDetailsObj->setUnityId($items['unity_id']);
                            $getSales = $orderDetailsDao->selectSalesForIndividual($orderDetailsObj);
                            if($getSales != null):
                                foreach($getSales as $sales){
                                    //  print_r($sales);
                                    $total = $sales['total_quantity'] * $sales['s_price'];
                                    $sum+=$total;
                           
                            


             
                      
                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$sales['PT_NAME']?></td>
                        <td style="text-align: center;"><?=$sales['P_NAME']?></td>
                        <td style="text-align: center;"><?=$sales['total_quantity']?></td>
                        <td style="text-align: center;"><?=$sales['UNITY_NAME']?></td>
                        <td style="text-align: center;"><?=$sales['s_price']?></td>
                        <td style="text-align: center;"><?=$total?></td>
                    </tr>











                    <?php  } endif;  } endif; ?>
                    <tr style='background:darkred; color: white;font-weight: bold;'>
                        <td colspan="6" style="text-align: left;">TOTAL:</td>
                        <td style="text-align: center;"><?=$sum?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>







<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>