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
                        <th>#</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                    style="width: 45px; height: 45px" class="rounded-circle" />

                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">Software engineer</p>
                            <p class="text-muted mb-0">IT department</p>
                        </td>
                        <td>
                            <span class="badge badge-success rounded-pill d-inline">Active</span>
                        </td>
                        <td>Senior</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-rounded">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt=""
                                    style="width: 45px; height: 45px" />

                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">Consultant</p>
                            <p class="text-muted mb-0">Finance</p>
                        </td>
                        <td>
                            <span class="badge badge-primary rounded-pill d-inline">Onboarding</span>
                        </td>
                        <td>Junior</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-rounded btn-sm "
                                data-mdb-ripple-color="dark">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt=""
                                    style="width: 45px; height: 45px" />

                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">Designer</p>
                            <p class="text-muted mb-0">UI/UX</p>
                        </td>
                        <td>
                            <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
                        </td>
                        <td>Senior</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-rounded btn-sm "
                                data-mdb-ripple-color="dark">
                                Edit
                            </button>
                        </td>
                    </tr>
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
                <form action="../../API/CONTROLLER/ProductTypeController.php?action=insert" method="POST">

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