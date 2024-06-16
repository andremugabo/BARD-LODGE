<?php  require_once '../../INCLUDES/header.php' ?>
<div class="msg">
</div>


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-3">
        <h2>Daily&nbsp;Expenses</h2>
    </div>



    <div class="s-btn text-end col-9">
        <!-- <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button> -->
        <!-- <button type="button" class="btn btn-success btn-sm"
            onclick="window.location.href='paidExpense.php'">Paid&nbsp;Expense</button> -->
        <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" || $employee_role == "BARMAN"): ?>
        <!-- <button type="button" class="btn btn-info btn-sm"
            onclick="window.location.href='allExpense.php'">All&nbsp;Daily&nbsp;Expense</button> -->
        <?php endif;?>
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
            data-bs-target="#ExpenseModal">Create&nbsp;A&nbsp;New&nbsp;Expense</button>
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>

    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">List of Registered Daily Expenses</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <!-- <th scope="col" style="text-align: center;">Subsession&nbsp;Entry&nbsp;Point</th> -->
                        <!-- <th scope="col" style="text-align: center;">Session</th> -->
                        <th scope="col" style="text-align: center;">Category</th>
                        <th scope="col" style="text-align: center;">Description</th>
                        <th scope="col" style="text-align: center;">Amount</th>
                        <th scope="col" style="text-align: center;">Date</th>
                        <!-- <th scope="col" style="text-align: center;">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $ExpenseDao = new ExpenseDao();
                $ExpenseObj = new Expense();
                $ExpenseObj->setSId($sessionInfo[0]['S_ID']);
                $selectExpense =$ExpenseDao->selectExpenseBySId($ExpenseObj);
                $num = 0;
                $sum = 0;
                if ($selectExpense):
                foreach ($selectExpense as $item) {  
                    $num++;
                    $sum += $item['EXP_AMOUNT'];           
                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <!-- <td style="text-align: center;">subSession/15-01-2024/0007</td> -->
                        <!-- <td style="text-align: center;"><?=$item['O_REF']?></td> -->
                        <td style="text-align: center;"><?=$item['EXP_CATEGORY']?></td>
                        <td style="text-align: center;"><?=$item['EXP_DESCRIPTION']?></td>
                        <td style="text-align: center;"><?=$item['EXP_AMOUNT']?></td>
                        <td style="text-align: center;"><?=$item['EXP_DATE']?></td>
                        <!-- <td style="text-align: center;">
                            <?php if($employee_role !== "WAITER" || $employee_role !== "BARMAN"):?>
                            <button type="button" class="btn btn-danger btn-sm mb-1"
                                onclick="window.location.href='../../API/CONTROLLER/ExpenseController.php?action=disable&exp_id=<?=$item['EXP_ID']?>'">Disable</button>&nbsp;
                            <?php endif ?>

                        </td> -->
                    </tr>

                    <?php } endif; ?>
                    <tr style='background:darkred; color: white;font-weight: bold;'>
                        <td colspan="3" style="text-align: left;">TOTAL:</td>
                        <td style="text-align: center;"><?=number_format($sum)?> Frw</td>
                        <td style="text-align: center;"></td>
                        <!-- <td style="text-align: center;"></td> -->
                    </tr>















                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- =================================================
                              INSERT MODAL
      ======================================================= -->

<div class="modal fade" id="ExpenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create&nbsp;Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form id="product_create"
                    action="../../API/CONTROLLER/ExpenseController.php?action=insert&s_id=<?=$sessionInfo[0]['S_ID'];?>"
                    method="POST">

                    <div class="col-12 mb-3">
                        <label for="category" class="col-form-label">Category:</label>
                        <select class="form-select" id="category" name="category" aria-label=".form-select-lg example"
                            required>
                            <option selected disabled value="">Choose&nbsp;Category</option>
                            <option value="FOOD">FOOD</option>
                            <option value="DINK">DINK</option>
                            <option value="WATER">WATER</option>
                            <option value="ELECTRICITY">ELECTRICITY</option>
                            <option value="ISUKU">ISUKU</option>
                            <option value="UMUTEKANO">UMUTEKANO</option>
                            <option value="INTERNET">INTERNET</option>
                            <option value="OTHER">OTHER</option>
                        </select>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="decs_other" class="col-form-label">Describe&nbsp;Other:</label>
                        <input type="text" class="form-control" name="decs_other" id="decs_other"
                            placeholder="OTHER EXPENSE DESCRIPTION" required>
                    </div> -->

                    <div class="mb-3">
                        <label for="description" class="col-form-label">Description:</label>
                        <input type="text" class="form-control" name="description" id="description"
                            placeholder="ENTER EXPENSE DESCRIPTION" required>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="col-form-label">Amount:</label>
                        <input type="text" class="form-control" name="amount" id="amount"
                            placeholder="ENTER PRODUCT NAME" required>
                    </div>




                    <button type="submit" name="CreateExpense" class="btn btn-danger w-100">Create&nbsp;Expense</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<?php require_once '../../INCLUDES/footer.php' ?>