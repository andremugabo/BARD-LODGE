<?php  require_once '../../INCLUDES/header.php' ?>
<div class="msg">
</div>


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-3">
        <h2>Order&nbsp;By&nbsp;Session</h2>
    </div>



    <div class="s-btn text-end col-9">
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='creditsOrdersReport.php'">Back</button>

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
                        <th scope="col" style="text-align: center;">Payment&nbsp;Mode</th>
                        <th scope="col" style="text-align: center;">Customer&nbsp;Name</th>
                        <th scope="col" style="text-align: center;">Customer&nbsp;Phone</th>
                        <th scope="col" style="text-align: center;">Total&nbsp;Amount</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $orderDao = new OrdersDao();
                $orderObj = new Orders();
                $s_id = $_GET['s_id'];
                $orderObj->setSId($s_id);
                $selectProduct =$orderDao->selectOrdersBySIdForReportDebt($orderObj);
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
                        <td style="text-align: center;"><?=$item['payment_mode']?></td>
                        <td style="text-align: center;"><?=$item['c_name']?></td>
                        <td style="text-align: center;"><?=$item['c_phone']?></td>
                        <td style="text-align: center;"><?=$item['O_AMOUNT']?></td>
                        <td style="text-align: center;">
                            <?php if($item['O_PAYMENT'] !== "PAID"):?>
                            <button type="button" class="btn btn-success btn-sm mb-1"
                                onclick="window.location.href='orderDetails.php?o_ref=<?=$item['O_REF']?>'">Add&nbsp;Items</button>&nbsp;
                            <?php endif ?>
                            <button type="button" class="btn btn-info btn-sm mb-1"
                                onclick="window.location.href='viewOrderDetailsReport.php?o_ref=<?=$item['O_REF']?>'">Details</button>
                        </td>
                    </tr>

                    <?php } endif; ?>
















                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../INCLUDES/footer.php' ?>