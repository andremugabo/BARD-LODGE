<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$sStockDao = new SStockDao();
require_once '../../API/MODEL/SStock.php';
$sStock = new SStock();
$p_id = $_GET['edit'];
$sStock->setPId($p_id);
// echo $e_id;
$selectById = $sStockDao->selectSStockById($sStock);
// print_r($selectById['E_ID']);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2 style="color:#0dcaf0;">Update Product Quantity Sales Stock</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-info w-50" onclick="window.location.href='SStock.php'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block  " style="background-color: rgba(0, 0, 0, 0.03);" tabindex="-1"
    role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Update Product Quantity</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/SStockController.php?action=updateQ" method="post">
                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['P_ID']?>" name="p_id"
                            placeholder="p_id">
                        <label for="floatingInput">p_id</label>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="p_type" class="col-form-label">Products&nbsp;Type:</label>
                        <select class="form-select form-select mb-3" id="type" name="p_type"
                            aria-label=".form-select-lg example" onchange="getCategory(this.value)" required>
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;Type</option>
                            <?php 
                                $typeDaoObj = new ProductTypeDao();
                                $selectType = $typeDaoObj->selectProductType();
                                if($selectType != null):
                                    foreach($selectType as $item){ ?>
                            <option value="<?=$item['PT_ID']?>"><?=$item['PT_NAME'];?></option>

                            <?php }?>
                            <?php endif?>

                        </select>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Products&nbsp;Category:</label>
                        <select class="form-select form-select mb-3" id="category" name="pc_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value=""><?=$selectById['PC_NAME']?></option>

                        </select>
                    </div> -->




                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Product:</label>
                        <input type="text" class="form-control" value="<?=$selectById['P_NAME']?>" name="p_mane"
                            id="p_mane" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Current&nbsp;Quantity:</label>
                        <input type="text" class="form-control" name="c_qty" value="<?=$selectById['P_QTY']?>"
                            placeholder="ENTER QUANTITY" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">New&nbsp;Quantity:</label>
                        <input type="text" class="form-control" name="qty" id="qty" placeholder="ENTER QUANTITY"
                            required>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Product&nbsp;Unity:</label>
                        <select class="form-select form-select mb-3" id="unity" name="unity_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value=""><?=$selectById['UNITY_NAME']?></option>
                            <?php 
                                $unityDaoObj = new UnityDao();
                                $selectUnity = $unityDaoObj->selectUnity();
                                print_r($selectUnity);
                                if($selectUnity != null):
                                    foreach($selectUnity as $item){
                            ?>
                            <option value="<?=$item['UNITY_ID']?>"><?=$item['UNITY_NAME']?></option>
                            <?php }  endif?>

                        </select>
                    </div> -->





                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-info" type="submit"
                        name="updateQty">Update&nbsp;Quantity</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>