<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2 style="color:#0dcaf0;">All&nbsp;Daily&nbsp;Orders</h2>
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
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $orderDao = new OrdersDao();
                $orderObj = new Orders();
                $orderObj->setEId($employee_eid);
                $orderObj->setSId($sessionInfo[0]['S_ID']);
                $selectProduct =$orderDao->selectOrdersBySId($orderObj);
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
                        <td style="text-align: center;">
                            <?php if($item['O_PAYMENT'] !== "PAID"):?>
                            <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" ):?>
                            <button type="button" class="btn btn-success btn-sm  mt-1"
                                onclick="window.location.href='orderDetails.php?o_ref=<?=$item['O_REF']?>'">Add&nbsp;Items</button>&nbsp;
                            <?php endif;?>
                            <?php endif ?>
                            <button type="button" class="btn btn-info btn-sm  mt-1"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=<?=$item['O_REF']?>'">Order&nbsp;Details</button>
                            <?php if($item['O_PAYMENT'] !== "PAID"):?>
                            &nbsp;<button type="button"
                                onclick="window.location.href='voidOrder.php?o_ref=<?=$item['O_REF']?>'"
                                class="btn btn-warning btn-sm  mt-1">Void&nbsp;Order</button>
                            <?php endif ?>
                        </td>
                    </tr>











                    <?php } endif; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../INCLUDES/footer.php' ?>