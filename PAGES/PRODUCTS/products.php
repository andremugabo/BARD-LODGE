<?php 
require_once '../../INCLUDES/header.php';

$productByFilter = "";

if (isset($_POST['filter'])) {
  
  $product = $_POST['p_id'];
  $productByFilter = "AND products.p_id = '".$product."' ";

}



?>


<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2>Products</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-sm btn-secondary m-1"
            onclick="window.location.href='sideDishes.php'">Products&nbsp;with&nbsp;Sides&nbsp;Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success m-1"
            onclick="window.location.href='Price.php'">Price</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-warning text-white m-1" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Create&nbsp;Product</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>
    </div>
</div>

<div class="container-fluid row section-title d-flex mb-3">
    <div class="s-title text-start col-lg-6 p-2 ">
        <div class="card">
            <div class="card-header">
                <strong>Filter&nbsp;Products</strong>
            </div>
            <div class="card-body card-block">
                <form class="row row-cols-lg-auto g-3 align-items-center justify-content-between" action=""
                    method="POST">


                    <div class="col-12">
                        <!-- <label class="visually-hidden" for="p_type">Products&nbsp;Types</label> -->
                        <select class="form-select" id="type" name="p_type" aria-label=".form-select-lg example"
                            onchange="getSCategory(this.value)" required>
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
                        <select class="form-select" id="sCategory" onchange="getSProduct(this.value)" name="pc_id"
                            required>
                            <option selected disabled value="">Choose&nbsp;Category</option>

                        </select>
                    </div>

                    <div class="col-12">
                        <!-- <label class="visually-hidden" for="">Preference</label> -->
                        <select class="form-select" id="sProduct" name="p_id" required>
                            <option selected>Choose&nbsp;Product</option>

                        </select>
                    </div>



                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-sm" name="filter">Filter&nbsp;Products</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="s-title text-start col-lg-6 p-2 ">
        <div class="card">
            <div class="card-header">
                <strong>Product Description </strong>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-primary btn-sm m-1"
                    onclick="window.location.href='productsType.php'">Type</button>
                <button type="button" class="btn btn-outline-success btn-sm m-1"
                    onclick="window.location.href='category.php'">Category</button>
                <button type="button" class="btn btn-outline-secondary btn-sm m-1"
                    onclick="window.location.href='sideDishes.php'">Products&nbsp;with&nbsp;Sides&nbsp;Dishes</button>
                <button type="button" class="btn btn-outline-success btn-sm m-1"
                    onclick="window.location.href='price.php'">Price</button>
                <button type="button" class="btn btn-outline-danger btn-sm m-1"
                    onclick="window.location.href='productImage.php'">Images</button>
                <button type="button" class="btn btn-outline-danger btn-sm"
                    onclick="window.location.href='unityDisplay.php'">Unity</button>
                <button type="button" class="btn btn-warning btn-sm m-1" data-bs-toggle="modal"
                    data-bs-target="#employeeModal">Create&nbsp;Product</button>

            </div>
        </div>
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
                        <th scope="col" style="text-align: center;">Packaging</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $product = new ProductsDao();
                    $selectProduct =$product->selectProductsByFilter($productByFilter);
                    $num = 0;
                    if ($selectProduct):
                    foreach ($selectProduct as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['P_CODE']?></td>
                        <td style="text-align: center;"><?=$item['UNITY_NAME']?></td>
                        <td style="text-align: center;"><?=$item['PC_NAME']?></td>
                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                        <td style="text-align: center;"><?=$item['PACKAGING']?></td>
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
                <form action="../../API/CONTROLLER/ProductsController.php?action=insert" method="POST">
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
                        <label for="p_package" class="col-form-label">Product&nbsp;Package:</label>
                        <input type="text" class="form-control" name="p_package" id="p_package"
                            placeholder="ENTER PRODUCT PACKAGE" required>
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