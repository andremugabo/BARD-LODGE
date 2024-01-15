<?php
require_once '../../INCLUDES/header.php';?>


<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Products Category</h2>
    </div>
    <div class="s-btn text-end col-7">
        <!-- <button type="button" class="btn btn-sm btn-secondary" onclick="window.location.href='sideDishes.php'">Sides
            Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='Price.php'">Price</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Insert&nbsp;Products&nbsp;Category</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger " onclick="window.location.href='products.php'">Back</button>
    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Products Category Table</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Type&nbsp;Name</th>
                        <th scope="col" style="text-align: center;">Category&nbsp;Name</th>
                        <!-- <th scope="col" style="text-align: center;">Products</th>
                        <th scope="col" style="text-align: center;">Purchasing&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Selling&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Special&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Unity</th> -->
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $category = new ProductCategoryDao();
                    $selectCategory =$category->selectProductCategory();
                    $num = 0;
                    // print_r($selectCategory);
                    if ($selectCategory != null):
                    foreach ($selectCategory as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['PT_NAME']?></td>
                        <td style="text-align: center;"><?=$item['PC_NAME']?></td>
                        <!-- <td style="text-align: center;"><?=$item['PPRICE']?></td>
                        <td style="text-align: center;"><?=$item['SPRICE']?></td>
                        <td style="text-align: center;"><?=$item['EPRICE']?></td>
                        <td style="text-align: center;"><?=$item['UNITY_NAME']?></td> -->
                        <td style="text-align: center;"><button type="button btn-sm" title="Edit Category Info"
                                class="btn btn-success table-btn"
                                onclick="window.location.href='editCategory.php?edit=<?=$item['PC_ID']?>'"><img
                                    src="../../ASSETS/SIMAGES/Edit_20px.png" class="align-middle table-img"
                                    alt=""></button>
                            <!-- &nbsp;<button type="button btn-sm" title="Disable Price Info"
                                class="btn btn-primary table-btn"
                                onclick="window.location.href='../../API/CONTROLLER/pricesController.php?action=disable&id=<?=$item['PRICE_ID']?>'"><img
                                    src="../../ASSETS/SIMAGES/Cancel 2_20px_1.png" class="align-middle table-img"
                                    alt=""></button> -->
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
                <h5 class="modal-title" id="exampleModalLabel">Insert&nbsp;Products&nbsp;Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../../API/CONTROLLER/ProductCategoryController.php?action=insert" method="POST">

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

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Products&nbsp;Category:</label>
                        <select class="form-select form-select mb-3" id="category" onchange="getProduct(this.value)"
                            name="pc_id" aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;Category</option>

                        </select>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="product" class="col-form-label">Product:</label>
                        <select class="form-select form-select mb-3" id="product" name="p_id" required
                            aria-label=".form-select-lg example">
                            <option selected disabled value=" ">Choose&nbsp;Product</option>

                        </select>
                    </div> -->

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
                        <label for="pc_name" class="col-form-label">Product&nbsp;Category:</label>
                        <input type="text" class="form-control" name="pc_name" id="pc_name"
                            placeholder="ENTER PRODUCT CATEGORY NAME" required>
                    </div>



                    <button type="submit" name="addCategory" class="btn btn-primary">Add&nbsp;Category</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>













<?php require_once '../../INCLUDES/footer.php';?>