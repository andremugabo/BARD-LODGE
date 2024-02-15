<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-6">
        <h2>Purchased Products On 2022-03-13</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-warning" onclick="window.location.href='../../PDF/pdf_products.php'"><img src="../../../ASSETS/IMAGES/PDF.png" class="align-middle table-img" alt=""></button>
        <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button>
        <button type="button" class="btn btn-info" onclick="window.location.href='price.php'">Prices</button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productModal"><img src="../../../ASSETS/IMAGES/Productp.png" class="align-middle title-img" alt=""></button> -->
        <button type="button" class="btn btn-sm btn-danger"
            onclick="window.location.href='purchasedReport.php'">BACK</button>

    </div>
</div>
<div class="col">
    <div class="card">
        <div class="card-header">
            <caption>List of Registered Closed Stocks</caption>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Session</th>
                        <th scope="col" style="text-align: center;">Products</th>
                        <th scope="col" style="text-align: center;">Product&nbsp;Codes</th>
                        <th scope="col" style="text-align: center;">Quantity</th>
                        <th scope="col" style="text-align: center;">Purchasing&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Total</th>
                        <!-- <th scope="col" style="text-align: center;">Action</th> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                $purchaseDao = new PurchaseProductsDao();
                $purchaseObj = new PurchaseProducts();
                $s_id = $_GET['s_id'];
                $purchaseObj->setSId($s_id);
                $dailyPurchased =$purchaseDao->selectPurchaseBySId($purchaseObj);
                // print_r($dailyPurchased);
                $num = 0;
                $total = 0;
                $sum = 0;
                if($dailyPurchased != null):
                    foreach($dailyPurchased as $item){$num++;

                    $total = $item['QTY_PUR'] * $item['P_PPRICE'];
                    $sum+=$total;

                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['S_REF']?></td>
                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                        <td style="text-align: center;"><?=$item['P_CODE']?></td>
                        <td style="text-align: center;"><?=$item['QTY_PUR']?></td>
                        <td style="text-align: center;"><?=number_format($item['P_PPRICE'])." Frw"?></td>
                        <td style="text-align: center;"><?=number_format($total)." Frw"?></td>
                        <!-- <td style="text-align: center;"><button type="button" class="btn btn-info table-btn" onclick="window.location.href='viewClosedStock.php?view=2022-03-13'"><img src="../../../ASSETS/IMAGES/View.png" class="align-middle table-img" alt=""></button>&nbsp;&nbsp;<button type="button" class="btn btn-warning table-btn" ><img src="../../../ASSETS/IMAGES/PDF.png" class="align-middle table-img" alt="" ></button></td> -->
                    </tr>
                    <?php } endif ?>
                    <tr>
                        <td colspan="6"> TOTAL:</td>
                        <td style="text-align: center;"><?=number_format($sum)." Frw"?></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>















<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>