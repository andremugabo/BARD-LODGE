<?php
require_once '../../INCLUDES/header.php';?>


<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Products Images</h2>
    </div>
    <div class="s-btn text-end col-7">
        <!-- <button type="button" class="btn btn-sm btn-secondary" onclick="window.location.href='sideDishes.php'">Sides
            Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='Price.php'">Price</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Insert&nbsp;Products&nbsp;Images</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger " onclick="window.location.href='products.php'">Back</button>
    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Products Images Table</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col">Image</th>
                        <th scope="col" style="text-align: center;">Product</th>
                        <th scope="col" style="text-align: center;">Actions</th>
                    </tr>
                </thead>


                <tbody>
                    <?php 
                 $image = new ProductImagesDao;
                 $selectImage =$image->selectImages();
                 $num = 0;
                //  print_r($selectImage);
                 if ($selectImage != null):
                 foreach ($selectImage as $item) {  $num++;
                
                 ?>
                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;">
                            <div class="d-flex align-items-center">
                                <img src="../../ASSETS/PIMAGES/<?=$item['PI_NAME']?>" alt=""
                                    style="width: 45px; height: 45px" class="rounded-circle" />

                            </div>
                        </td>
                        <td style="text-align: center;">
                            <?=$item['P_NAME']?>
                        </td>
                        <td style="text-align: center;">
                            <button type="button" class="btn btn-primary btn-sm btn-rounded"
                                onclick="window.location.href='editImage.php?edit=<?=$item['PI_ID']?>'">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <?php
                 }
                endif;
                
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- =================================================
                              INSERT MODAL
      ======================================================= -->


<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insert&nbsp;Products&nbsp;Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../../API/CONTROLLER/ProductImageController.php?action=insert" method="POST"
                    enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="p_type" class="col-form-label">Products&nbsp;Type:</label>
                        <select class="form-select form-select mb-3" id="type" name="p_type"
                            aria-label=".form-select-lg example" onchange="getimage(this.value)" required>
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
                        <label for="role" class="col-form-label">Products&nbsp;image:</label>
                        <select class="form-select form-select mb-3" id="image" onchange="getProduct(this.value)"
                            name="pc_id" aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;image</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product" class="col-form-label">Product:</label>
                        <select class="form-select form-select mb-3" id="product" name="p_id" required
                            aria-label=".form-select-lg example">
                            <option selected disabled value=" ">Choose&nbsp;Product</option>

                        </select>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Product&nbsp;Unity:</label>
                        <select class="form-select form-select mb-3" id="unity" name="unity_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Unity</option>
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
                        <label for="p_name" class="col-form-label">Purchasing&nbsp;Price:</label>
                        <input type="text" class="form-control" name="pprice" id="pprice"
                            placeholder="ENTER PURCHASING PRICE" required>
                    </div> -->
                    <!-- <div class="mb-3">
                        <label for="p_name" class="col-form-label">Selling&nbsp;Price:</label>
                        <input type="text" class="form-control" name="sprice" id="sprice"
                            placeholder="ENTER SELLING PRICE" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Product&nbsp;Image:</label>
                        <input type="file" class="form-control" name="pi_name" id="pi_name"
                            placeholder="ENTER PRODUCT IMAGE" required>
                    </div>



                    <button type="submit" name="addImage" class="btn btn-primary">Add&nbsp;Image</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>













<?php require_once '../../INCLUDES/footer.php';?>