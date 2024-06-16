<?php  require_once '../../INCLUDES/header.php' ?>
<?php

$oincomeDao = new OincomeDao();
$oincomeObj = new Oincome();
$oi_id = $_GET['edit'];
$oincomeObj->setOiId($oi_id);
$selectById = $oincomeDao->selectOIncomeById($oincomeObj);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Edit Product</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50"
            onclick="window.location.href='billardAndRoom.php'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block  " style="background-color: rgba(0, 0, 0, 0.03);" tabindex="-1"
    role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Edit Product</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/OincomeController.php?action=edit" method="post">

                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['oi_id']?>"
                            name="oi_id">
                        <label for="floatingInput">p_id</label>
                    </div>

                    <div class="mb-3">
                        <label for="oi_category" class="col-form-label">Products&nbsp;Category:</label>
                        <select class="form-select form-select mb-3" id="oi_category" name="oi_category"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value=""><?=$selectById['oi_category']?></option>
                            <option value="ROOM">ROOM</option>
                            <option value="BILLIARD">BILLIARD</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Product&nbsp;Name:</label>
                        <input type="text" class="form-control" name="p_name" id="p_name"
                            value="<?=$selectById['oi_name']?>" placeholder="Enter Product">
                    </div>

                    <div class="mb-3">
                        <label for="p_price" class="col-form-label">Purchase&nbsp;Price:</label>
                        <input type="text" class="form-control" name="p_price" id="p_price"
                            placeholder="ENTER PURCHASE PRICE" value="<?=number_format($selectById['oi_price'])?>"
                            required>
                    </div>

                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit"
                        name="editOIncome">Edit&nbsp;Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>