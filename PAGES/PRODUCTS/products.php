<?php 
require_once '../../INCLUDES/header.php';

$productF = "";

if (isset($_POST['filter'])) {
  
  $product = $_POST['productF'];
  $productF = "AND products.p_id = '".$product."' ";



}



?>


<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Products</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-sm btn-secondary"
            onclick="window.location.href='sideDishes.php'">Products&nbsp;with&nbsp;Sides&nbsp;Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='Price.php'">Price</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Create&nbsp;Product</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>
    </div>
</div>

<div class="container-fluid section-title d-flex mb-3">
    <div class="s-title text-start col-8 p-2 " style="background: #222e3c;">
        <form class="row row-cols-lg-auto g-3 align-items-center justify-content-between" action="" method="POST">


            <div class="col-12">
                <!-- <label class="visually-hidden" for="p_type">Products&nbsp;Types</label> -->
                <select class="form-select" id="p_typeF" name="p_typeF" onchange="getCategoryF(this.value)" required>
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

            <div class="col-12">
                <!-- <label class="visually-hidden" for="productF">Preference</label> -->
                <select class="form-select form-select mb-3" id="category" name="pc_id"
                    aria-label=".form-select-lg example" required>
                    <option selected disabled value="">Choose&nbsp;Product&nbsp;Category</option>

                </select>
            </div>

            <div class="col-12">
                <!-- <label class="visually-hidden" for="">Preference</label> -->
                <select class="form-select" id="productF" name="productF">
                    <option selected>Choose&nbsp;Product</option>

                </select>
            </div>



            <div class="col-12">
                <button type="submit" class="btn btn-warning btn-sm" name="filter">Filter&nbsp;Products</button>
            </div>
        </form>
        <!-- <div class="period_diplay">   SALES REPORT ON <?=date("d-m-y");?>    </div> -->
    </div>

    <div class="s-btn text-end col-4">
        <button type="button" class="btn btn-warning btn-sm"
            onclick="window.location.href='../../PDF/pdf_products.php'"><img src="../../ASSETS/SIMAGES/PDF.png"
                class="align-middle table-img" alt=""></button>
        <button type="button" class="btn btn-success btn-sm"
            onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary btn-sm"
            onclick="window.location.href='description.php'">Description</button>
        <!-- <button type="button" class="btn btn-info" onclick="window.location.href='price.php'">Prices</button> -->
        <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productModal"><img src="../../../ASSETS/IMAGES/Productp.png" class="align-middle title-img" alt=""></button> -->
        <!-- <button type="button" class="btn btn-danger" onclick="window.location.href='./'">BACK</button> -->

    </div>
</div>

<div class="col" style="min-height: 100vh;">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Products Table</strong>
        </div>
        <div class="card-body overflow-auto" style="min-height: 40vh; overflow:auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">P-Code</th>
                        <th scope="col" style="text-align: center;">Unity</th>
                        <th scope="col" style="text-align: center;">Category</th>
                        <th scope="col" style="text-align: center;">Products</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $product = new ProductsDao();
                    $selectProduct =$product->selectProducts();
                    $num = 0;
                    if ($selectProduct != null):
                    foreach ($selectProduct as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['P_CODE']?></td>
                        <td style="text-align: center;"><?=$item['UNITY_NAME']?></td>
                        <td style="text-align: center;"><?=$item['PC_NAME']?></td>
                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                        <td style="text-align: center;"><button type="button btn-sm" title="Edit Product Info"
                                class="btn btn-primary table-btn"
                                onclick="window.location.href='editProducts.php?edit=<?=$item['P_ID']?>'"><img
                                    src="../../ASSETS/SIMAGES/Edit_20px.png" class="align-middle table-img"
                                    alt=""></button></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Add&nbsp;New&nbsp;Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../../API/CONTROLLER/productsController.php?action=insert" method="POST">
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
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;Category</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Product&nbsp;Name:</label>
                        <input type="text" class="form-control" name="p_name" id="p_name"
                            placeholder="ENTER PRODUCT NAME" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Product&nbsp;Unity:</label>
                        <select class="form-select form-select mb-3" id="unity" name="unity_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;Unity</option>
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

                    <button type="submit" name="addProduct" class="btn btn-primary">Add&nbsp;Product</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>













<?php require_once '../../INCLUDES/footer.php';

?>