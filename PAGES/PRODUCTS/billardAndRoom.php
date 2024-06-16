<?php
require_once '../../INCLUDES/header.php';?>


<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Billiard And Rooms</h2>
    </div>
    <div class="s-btn text-end col-7">
        <!-- <button type="button" class="btn btn-sm btn-secondary" onclick="window.location.href='sideDishes.php'">Sides
            Dishes</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='Price.php'">Price</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Insert&nbsp;Billiard Or Rooms</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger " onclick="window.location.href='products.php'">Back</button>
    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Products Billiard And Rooms</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Category</th>
                        <th scope="col" style="text-align: center;">Product</th>
                        <th scope="col" style="text-align: center;">Price</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $oincomeDao = new OincomeDao();
                    $selectOincome =$oincomeDao->selectOIncome();
                    $num = 0;
                    if ($selectOincome != null):
                    foreach ($selectOincome as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['oi_category']?></td>
                        <td style="text-align: center;"><?=$item['oi_name']?></td>
                        <td style="text-align: center;"><?=$item['oi_price']?></td>
                        <td style="text-align: center;"><button type="button btn-sm" title="Edit Price Info"
                                class="btn btn-success table-btn"
                                onclick="window.location.href='editOIncome.php?edit=<?=$item['oi_id']?>'"><img
                                    src="../../ASSETS/SIMAGES/Edit_20px.png" class="align-middle table-img"
                                    alt=""></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Insert&nbsp;Products&nbsp;Prices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../../API/CONTROLLER/OincomeController.php?action=create" method="POST">

                    <div class="mb-3">
                        <label for="oi_category" class="col-form-label">Products&nbsp;Type:</label>
                        <select class="form-select form-select mb-3" id="oi_category" name="oi_category"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Category</option>
                            <option value="ROOM">ROOM</option>
                            <option value="BILLIARD">BILLIARD</option>
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Product&nbsp;Name:</label>
                        <input type="text" class="form-control" name="p_name" id="p_name"
                            placeholder="ENTER PRODUCT NAME" required>
                    </div>
                    <div class="mb-3">
                        <label for="p_price" class="col-form-label">Product&nbsp;Price:</label>
                        <input type="text" class="form-control" name="p_price" id="p_price"
                            placeholder="ENTER PRODUCT PRICE" required>
                    </div>

                    <button type="submit" name="oi_product" class="btn btn-primary">Add&nbsp;Product</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>













<?php require_once '../../INCLUDES/footer.php';?>