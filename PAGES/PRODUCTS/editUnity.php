<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$unityDao = new UnityDao();
// require_once '../../API/MODEL/Prices.php';
$unity = new Unity();
$unity_id = $_GET['edit'];
$unity->setUnityId($unity_id);
// echo $e_id;
$selectById = $unityDao->selectOneUnity($unity);
// print_r($selectById);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Edit Unity</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50" onclick="window.location.href='price.php'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block  " style="background-color: rgba(0, 0, 0, 0.03);" tabindex="-1"
    role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Edit Unity</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/UnityController.php?action=edit" method="post">
                    <!-- <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['PRICE_ID']?>"
                            name="price_id" placeholder="PRICE_ID">
                        <label for="floatingInput">price_id</label>
                    </div> -->

                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['UNITY_ID']?>"
                            name="unity_id" placeholder="UNITY_ID">
                        <label for="floatingInput">unity_id</label>
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
                        <label for="p_name" class="col-form-label">Current&nbsp;Unity&nbsp;Name:</label>
                        <input type="text" class="form-control" name="punity_name" id="unity_name"
                            value="<?=$selectById['UNITY_NAME']?>" placeholder="Enter Product" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Unity&nbsp;Name:</label>
                        <input type="text" class="form-control" name="unity_name" id="unity_name"
                            placeholder="Enter a New Unity" required>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Choose&nbsp;Product&nbsp;Unity:</label>
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

                    <!-- <div class="mb-3">
                        <label for="p_name" class="col-form-label">Purchase&nbsp;Price:</label>
                        <input type="text" class="form-control" name="pprice" id="pprice"
                            placeholder="ENTER PURCHASE PRICE" value="<?=$selectById['PPRICE']?>" required>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="p_name" class="col-form-label">Selling&nbsp;Price:</label>
                        <input type="text" class="form-control" name="sprice" id="sprice"
                            placeholder="ENTER SELLING PRICE" value="<?=$selectById['SPRICE']?>" required>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="p_name" class="col-form-label">Special&nbsp;Price:</label>
                        <input type="text" class="form-control" name="eprice" id="eprice"
                            placeholder="ENTER SPECIAL PRICE" value="<?=$selectById['EPRICE']?>" required>
                    </div> -->






                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit"
                        name="editUnity">Edit&nbsp;Unity</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>