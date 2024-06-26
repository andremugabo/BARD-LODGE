<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6 specialEvent">
        <h2 style="color:#0dcaf0;">Special&nbsp;Order&nbsp;Details</h2>
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
        <button type="button" class="btn btn-sm btn-info " onclick="window.location.href='index.php'">Back</button>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <strong>Products&nbsp;Types</strong>
    </div>
    <div class="card-body" id="product_type">

    </div>
</div>
<div class="card">
    <div class="card-header">
        <strong>Products&nbsp;Categories</strong>
    </div>
    <div class="card-body" id="product_category">

    </div>
</div>
<?php
$o_ref = $_GET['o_ref'];
$specialDao = new SpecialDao();
$specialObj = new Special();
$specialObj->setORef($o_ref);
$oInfo = $specialDao->selectSpecialById($specialObj);
// print_r($oInfo);


?>
<div class="oRefInput">
    <input type="text" value="<?=$o_ref?>" id="oRefInput" style="display:none;">
</div>
<!-- search -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Search&nbsp;By</strong> First&nbsp;Character
        </div>
        <div class="card-body card-block">
            <form action="" method="post" class="form-horizontal" id="searchByCharacter">
                <div class="row form-group">
                    <div class="col col-md-12">
                        <div class="input-group">
                            <input type="text" id="characterProduct" name="input2-group2" placeholder="First Character"
                                class="form-control">
                            <div class="input-group-btn"><button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
<!-- search -->
<div class="content mt-3">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-lg-6">
                <div class="row overflow-auto" id="productDetails">

                    <!-- PRODUCTS GOES HERE -->

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Payment&nbsp;Note</strong>
                    </div>

                    <div class="card-body">
                        <div class="title_o m-1 p-1 row">
                            <span>GREEN-GARDEN-BAR</span>
                        </div>
                        <div class="address_o  m-1 row">
                            <div class="col-5 justify-content-start">
                                <p>Tin : 103477797</p>
                                <p>Tel : (+250) 788 322 151</p>
                            </div>
                            <div class="col-7  justify-content-end">
                                <p>P.O Box: 7547 Kigali- Rwanda</p>
                                <!-- <p>Address : Kigali-Rwanda</p> -->
                                <p>Website : www.xxxx.com</p>
                            </div>
                        </div>
                        <div class="address_info m-1  row">
                            <div class="col-6 justify-content-start">
                                <p>Ref : <?=$oInfo['O_REF']?></p>
                                <p>Served&nbsp;By:&nbsp; <?=$oInfo['LASTNAME']." ".$oInfo['FIRSTNAME']?></p>
                            </div>
                            <div class="col-6 justify-content-end">
                                <p style="font-size:10px;">Session : <?=$oInfo['S_REF']?></p>
                                <p>Date: <?=$oInfo['O_DATE']?> </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- <caption>List of Registered Products in Stock</caption> -->
                            <table class="table table-striped table-sm table-hover">
                                <thead>
                                    <tr style='background:#e3e2e2; color: black;font-weight: bold;'>
                                        <th scope="col" style="text-align: center;">#</th>
                                        <th scope="col" style="text-align: center;">Item</th>
                                        <th scope="col" style="text-align: center;">Unity</th>
                                        <th scope="col" style="text-align: center;">Qty</th>
                                        <th scope="col" style="text-align: center;">U/P</th>
                                        <th scope="col" style="text-align: center;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $specialDetailsDao = new SpecialDetailsDao();
                                    $specialDetails = new SpecialDetails();
                                    $specialDaoObj = new SpecialDao();
                                    $specialObj = new Special;
                                    $specialObj->setORef($_GET['o_ref']);
                                    $specialInfo = $specialDaoObj->selectSpecialById($specialObj);
                                    // echo$SpecialInfo['O_ID'];
                                    $specialDetails->setOId($specialInfo['O_ID']);
                                    $selectedSpecial = $specialDetailsDao->selectSpecialDetailsByOId($specialDetails);
                                    $num = 0;
                                    $total = 0;
                                    $sum = 0;
                                    if ($selectedSpecial != null):
                                    foreach ($selectedSpecial as $item) {  $num++;
                                    $total = $item['S_PRICE']*$item['P_QTY'];
                                    $sum += $total;    
                                    
                                    
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?=$num?></td>
                                        <td style="text-align: center;"><?=$item['P_NAME']?></td>
                                        <td style="text-align: center;"><?=$item['UNITY_NAME']?></td>
                                        <td style="text-align: center;"><?=$item['P_QTY']?></td>
                                        <td style="text-align: center;"><?=$item['S_PRICE']?></td>
                                        <td style="text-align: center;"><?=$total?></td>
                                    </tr>

                                    <?php 
                            }
                        endif;
                             ?>





                                    <tr style='background:darkred; color: white;font-weight: bold;'>
                                        <td colspan="5" style="text-align: left;">TOTAL:</td>
                                        <td style="text-align: center;"><?=$sum?></td>
                                    </tr>


                                </tbody>


                            </table>
                            <div class="p-1 d-flex justify-content-between">
                                <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" || $employee_role == "BARMAN"): ?>
                                <a type="submit" target="_blank" name="printSpecial" class="btn btn-info "
                                    href='../PDF/pdf_Special.php?o_ref=<?=$_GET['o_ref']?>'>Print</a>

                                <a type="submit" name="payBill" class="btn btn-danger "
                                    href='billSpecial.php?o_ref=<?=$_GET['o_ref']?>'>Pay&nbsp;Bill</a>
                                <?php endif;?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="edit_modal hide">



</div>


<?php require_once '../../INCLUDES/footer.php' ?>