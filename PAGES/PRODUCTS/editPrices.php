<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$productsDao = new ProductsDao();
require_once '../../API/MODEL/Products.php';
$products = new Products();
$p_id = $_GET['edit'];
$products->setPId($p_id);
// echo $e_id;
$selectById = $productsDao->getProductsById($products);
// print_r($selectById['E_ID']);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Edit Prices</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50" onclick="window.location.href='products.php'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block bg-dark " tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Edit Prices</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/pricesController.php?action=edit" method="post">
                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['P_ID']?>" name="p_id"
                            placeholder="e_id">
                        <label for="floatingInput">p_id</label>
                    </div>

                    <div class="mb-3">
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
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Products&nbsp;Category:</label>
                        <select class="form-select form-select mb-3" id="category" name="pc_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value=""><?=$selectById['PC_NAME']?></option>

                        </select>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="p_name"
                            value="<?=$selectById['P_NAME']?>" placeholder="Enter Product" required>
                        <label for="floatingInput">Product</label>
                    </div>

                    <div class="mb-3">
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
                    </div>





                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit"
                        name="editProduct">Edit&nbsp;Prices</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>