<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-6">
        <h2>Daily Sales 2022-03-13</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-warning" onclick="window.location.href='../../PDF/pdf_products.php'"><img src="../../../ASSETS/IMAGES/PDF.png" class="align-middle table-img" alt=""></button>
        <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button>
        <button type="button" class="btn btn-info" onclick="window.location.href='price.php'">Prices</button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productModal"><img src="../../../ASSETS/IMAGES/Productp.png" class="align-middle title-img" alt=""></button> -->
        <button type="button" class="btn btn-sm btn-danger"
            onclick="window.location.href='salesReport.php'">BACK</button>

    </div>
</div>
<div class="col">
    <div class="card">
        <div class="card-header">
            <caption>List of Daily Sales</caption>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Session</th>
                        <th scope="col" style="text-align: center;">Products</th>
                        <th scope="col" style="text-align: center;">Unity</th>
                        <th scope="col" style="text-align: center;">Quantity</th>
                        <th scope="col" style="text-align: center;">Purchasing&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Selling&nbsp;Price</th>
                        <th scope="col" style="text-align: center;">Profit</th>
                        <!-- <th scope="col" style="text-align: center;">Action</th> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                $closingSalesReportDao = new Closing_sales_reportDao();
                $closingSalesReportObj = new Closing_sales_report();
                $s_ref = $_GET['s_ref'];
                $closingSalesReportObj->setSRef($s_ref);
                $dailySalesReport =$closingSalesReportDao->selectSReportBySRef($closingSalesReportObj);
                // print_r($dailySalesReport);
                $num = 0;
                $total = 0;
                $sumSPrice = 0;
                $sumPPrice = 0;
                $sumProfitPrice = 0;
                $profit = 0;
                if($dailySalesReport != null):
                    foreach($dailySalesReport as $item){$num++;
                    $profit = $item['P_SPRICE'] - $item['P_PPRICE'];
                    $totalSellingPrice = $item['P_QTY'] * $item['P_SPRICE'];
                    $totalPurchasingPrice = $item['P_QTY'] * $item['P_PPRICE'];
                    $totalProfitPrice =  $profit * $item['P_QTY'];
                   
                    $sumSPrice+=$totalSellingPrice;
                    $sumPPrice+=$totalPurchasingPrice;
                    $sumProfitPrice+=$totalProfitPrice;

                ?>

                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['S_REF']?></td>
                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                        <td style="text-align: center;"><?=$item['UNITY_NAME']?></td>
                        <td style="text-align: center;"><?=$item['P_QTY']?></td>
                        <td style="text-align: center;"><?=number_format($item['P_PPRICE'])." Frw"?></td>
                        <td style="text-align: center;"><?=number_format($item['P_SPRICE'])." Frw"?></td>
                        <td style="text-align: center;"><?=number_format($profit)." Frw"?></td>
                    </tr>
                    <?php } endif ?>
                    <tr>
                        <td colspan="5"> TOTAL:</td>
                        <td style="text-align: center;"><?=number_format($sumPPrice)." Frw"?></td>
                        <td style="text-align: center;"><?=number_format($sumSPrice)." Frw"?></td>
                        <td style="text-align: center;"><?=number_format($sumProfitPrice)." Frw"?></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>















<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>