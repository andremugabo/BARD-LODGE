<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-6">
        <h2>Current Main Stock On <?=date("Y-M-d")?></h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-warning" onclick="window.location.href='../../PDF/pdf_products.php'"><img src="../../../ASSETS/IMAGES/PDF.png" class="align-middle table-img" alt=""></button>
        <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button>
        <button type="button" class="btn btn-info" onclick="window.location.href='price.php'">Prices</button> -->
        <button type="button" class="btn btn-sm btn-warning" onclick="window.location.href='../PDF/pdf_gStock.php'"><img
                src="../../ASSETS/SIMAGES/PDF 2_48px.png" class="align-middle" alt="" style="width: 20px;"></button>
        <button type="button" class="btn btn-sm btn-danger"
            onclick="window.location.href='generalReport.php'">BACK</button>

    </div>
</div>
<div class="col">
    <div class="card">
        <div class="card-header">
            <caption>List of Products Currently in General Stock</caption>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Products</th>
                        <th scope="col" style="text-align: center;">Quantity</th>
                        <th scope="col" style="text-align: center;">Purchasing&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Total</th>
                        <!-- <th scope="col" style="text-align: center;">Action</th> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                $gStockDao = new GStockDao();
                $gStockObj = new GStock();
                $currentStock =$gStockDao->selectGStock();
                // print_r($currentStock);
                $num = 0;
                $total = 0;
                $sum = 0;
                if($currentStock != null):
                    foreach($currentStock as $item){$num++;

                    $total = $item['P_QTY'] * $item['P_PPRICE'];
                    $sum+=$total;

                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                        <td style="text-align: center;"><?=$item['P_QTY']?></td>
                        <td style="text-align: center;"><?=number_format($item['P_PPRICE'])." Frw"?></td>
                        <td style="text-align: center;"><?=number_format($total)." Frw"?></td>
                    </tr>
                    <?php } endif ?>
                    <tr>
                        <td colspan="4"> TOTAL:</td>
                        <td style="text-align: center;"><?=number_format($sum)." Frw"?></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>















<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>