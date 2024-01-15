<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$productImagesDao = new ProductImagesDao();
require_once '../../API/MODEL/ProductImages.php';
$images = new ProductImages();
$pi_id = $_GET['edit'];
$images->setPiId($pi_id);
// echo $pi_id;
$selectById = $productImagesDao->getImagesById($images);
// print_r($selectById);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Edit Products Image</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50"
            onclick="window.location.href='productImage.php'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block  " style="background-color: rgba(0, 0, 0, 0.03);" tabindex="-1"
    role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Edit Products Image</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/ProductImageController.php?action=edit" method="post"
                    enctype="multipart/form-data">

                    <div class="mb-3" style="display:none;">
                        <label for="phone" class="col-form-label">Employee&nbsp;Id:</label>
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['PI_ID']?>" name="pi_id"
                            placeholder="e_id" required>
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
                        <select class="form-select form-select mb-3" id="category" onchange="getProduct(this.value)"
                            name="pc_id" aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;Category</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product" class="col-form-label">Product:</label>
                        <select class="form-select form-select mb-3" id="product" name="p_id" required
                            aria-label=".form-select-lg example">
                            <option selected disabled value=" "><?=$selectById['P_NAME']?></option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="col-form-label">Image:</label>
                        <br>
                        <img src="../../ASSETS/PIMAGES/<?=$selectById['PI_NAME']?>" style="width: 75px; height: 75px"
                            alt="Product Image">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="col-form-label">Image File:</label>
                        <input type="file" class="form-control rounded-4" name="pi_name" required>
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





                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit"
                        name="editImage">Edit&nbsp;Product&nbsp;Image</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>