<?php  require_once '../../INCLUDES/header.php' ?>
<div class="msg">
</div>


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-3">
        <h2>Daily&nbsp;Games</h2>
    </div>



    <div class="s-btn text-end col-9">
        <!-- <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button> -->

        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
            data-bs-target="#orderModal">Create&nbsp;a&nbsp;Billiard&nbsp;Game</button>
        <button type="button" class="btn btn-sm btn-danger " onclick="window.location.href='order.php'">Back</button>

    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">List of Registered Daily Billiards Games</strong>
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
                        <td style="text-align: center;">
                            <?php if($item['O_PAYMENT'] !== "PAID"):?>
                            <button type="button" class="btn btn-success btn-sm mb-1"
                                onclick="window.location.href='orderDetails.php?o_ref=<?=$item['O_REF']?>'">Add&nbsp;Items</button>&nbsp;
                            <?php endif ?>
                            <button type="button" class="btn btn-info btn-sm mb-1"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=<?=$item['O_REF']?>'">Details</button>
                        </td>
                    </tr>

                    <?php } endif; ?>
















                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- =================================================
                              INSERT MODAL
      ======================================================= -->

<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create&nbsp;a&nbsp;Billiard&nbsp;Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form id="product_create"
                    action="../../API/CONTROLLER/OrdersController.php?action=insert&s_id=<?=$sessionInfo[0]['S_ID'];?>"
                    method="POST">

                    <div class="mb-3">
                        <label for="Player1" class="col-form-label">Player1&nbsp;Name:</label>
                        <input type="text" class="form-control" name="Player1" id="Player1"
                            placeholder="ENTER PLAYER I NAME:" required>
                    </div>

                    <div class="mb-3">
                        <label for="Player2" class="col-form-label">Player2&nbsp;Name:</label>
                        <input type="text" class="form-control" name="Player2" id="Player2"
                            placeholder="ENTER PLAYER II NAME:" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Game:</label>
                        <select class="form-select form-select mb-3" id="role" name="e_role" required>
                            <option selected disabled value="">Choose&nbsp;Game</option>
                            <?php
                            $oincomeDao = new OincomeDao();
                            $selectedOIncome = $oincomeDao->selectOIncomeByCategory();
                            print_r($selectedOIncome);
                            if($selectedOIncome):                          
                            foreach($selectedOIncome as $item){?>
                            <option value="<?=$item['oi_id']?>"><?=$item['oi_name']?></option>
                            <?php }
                            endif;
                            ?>
                        </select>
                    </div>

                    <div class="message_login mb-3 ">

                    </div>

                    <button type="submit" name="CreateOrder"
                        class="btn btn-danger w-100">Create&nbsp;a&nbsp;Game</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<?php require_once '../../INCLUDES/footer.php' ?>