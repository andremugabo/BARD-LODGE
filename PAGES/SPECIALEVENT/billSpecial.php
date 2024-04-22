<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2 style="color:#0dcaf0;">Special&nbsp;Details&nbsp;View</h2>
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
<?php
$o_ref = $_GET['o_ref'];
$specialDao = new SpecialDao();
$specialObj = new Special();
$specialObj->setORef($o_ref);
$oInfo = $specialDao->selectSpecialById($specialObj);
// print_r($oInfo);


?>


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Payment&nbsp;Note</strong>
                    </div>

                    <div class="card-body">
                        <div class="title_o m-1 p-1 row">
                            <span>GREEN-WORLD-CORNER</span>
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
                                <p>Served&nbsp;By:&nbsp;<?=$oInfo['LASTNAME']." ".$oInfo['FIRSTNAME']?></p>
                            </div>
                            <div class=" col-6 justify-content-end">
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
                                    $specialObj = new Special();
                                    $specialObj->setORef($_GET['o_ref']);
                                    $specialInfo = $specialDaoObj->selectSpecialById($specialObj);
                                    // echo$specialInfo['O_ID'];
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
                            <div class="p-1">
                                <a type="submit" target="_blank" name="printOrder" class="btn btn-info "
                                    href='../PDF/pdf_special.php?o_ref=<?=$_GET['o_ref']?>'>Print</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">PAY&nbsp;BILL</strong>
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Pay Invoice</h3>
                                </div>
                                <hr>
                                <form
                                    action="../../API/CONTROLLER/SpecialController.php?action=pay&special=<?=$oInfo['O_ID']?>"
                                    method="post">
                                    <div class="form-group text-center">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><img
                                                    src="../../ASSETS/SIMAGES/credit-removebg-preview.png"
                                                    alt="payment mode" width="80" height="60"></li>
                                            <li class="list-inline-item"><img src="../../ASSETS/SIMAGES/aitelmoney.png"
                                                    alt="payment mode" width="60" height="50"></li>
                                            <li class="list-inline-item"><img src="../../ASSETS/SIMAGES/momo.png"
                                                    alt="payment mode" width="60" height="50"></li>
                                            <li class="list-inline-item"><img
                                                    src="../../ASSETS/SIMAGES/Shutterstock_1727811dq-removebg-preview.png"
                                                    alt="payment mode" width="60" height="50"></li>

                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                                        <input name="" type="text" class="form-control"
                                            value="<?= number_format($sum).' Frw' ?>" disabled>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                                        <input id="o_amount" name="o_amount" type="text" class="form-control"
                                            aria-required="true" value="<?=$sum?>">
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="cc-name" class="control-label mb-1">Payment&nbsp;Mode</label>
                                        <select name="payment_mode" id="pay_mode" class="form-select form-select mb-3"
                                            required>
                                            <option value="" disabled selected>Select&nbsp;Payment&nbsp;Mode</option>
                                            <option value="CASH">CASH</option>
                                            <option value="MOMO">MOMO</option>
                                            <option value="CREDIT CARD">CREDIT&nbsp;CARD</option>
                                            <option value="DEBT">DEBT(DETTE)</option>
                                            <option value="MIXED">MIXED&nbsp;PAYMENT</option>
                                        </select>
                                    </div>
                                    <div class="customer_debt mt-2  hide">
                                        <div class="form-group c_name">
                                            <label for="cc-number" class="control-label mb-1">Customer&nbsp;Name</label>
                                            <input id="" name="c_name" type="text" class="form-control">
                                        </div>
                                        <div class="form-group c_phone">
                                            <label for="cc-number"
                                                class="control-label mb-1">Customer&nbsp;Phone</label>
                                            <input id="" name="c_phone" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mixed_payment mt-2 hide">
                                        <h4>Mixed&nbsp;Payment</h4>
                                        <div class="form-group c_name">
                                            <label for="cc-number" class="control-label mb-1">MOMO</label>
                                            <input id="" name="c_name" type="text" value="0" class="form-control">
                                        </div>
                                        <div class="form-group c_name">
                                            <label for="cc-number" class="control-label mb-1">CASH</label>
                                            <input id="" name="c_name" type="text" value="0" class="form-control">
                                        </div>
                                        <div class="form-group c_name">
                                            <label for="cc-number" class="control-label mb-1">CREDIT&nbsp;CARD</label>
                                            <input id="" name="c_name" type="text" value="0" class="form-control">
                                        </div>
                                        <div class="form-group c_name">
                                            <label for="cc-number" class="control-label mb-1">DEBT(DETTE)</label>
                                            <input id="" name="c_name" type="text" value="0" class="form-control">
                                        </div>
                                    </div>

                                    <div>
                                        <button id="payment-button" name="placeSpecial" type="submit"
                                            class="btn btn-lg btn-info w-50 m-5">
                                            <span id="payment-button-amount">Place&nbsp;Special&nbsp;Order</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->

            </div>
            <!--/.col-->


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<script>
document.querySelector('#pay_mode').addEventListener('change', function() {
    const customerDebt = document.querySelector('.customer_debt');
    const mixedPayment = document.querySelector('.mixed_payment');

    if (this.value === 'MIXED') {
        if (!customerDebt.classList.contains('hide')) {
            customerDebt.classList.add('hide');
        }
        mixedPayment.classList.remove('hide');
    } else if (this.value === 'DEBT') {
        if (!mixedPayment.classList.contains('hide')) {
            mixedPayment.classList.add('hide');
        }
        customerDebt.classList.remove('hide');
    } else {
        customerDebt.classList.add('hide');
        mixedPayment.classList.add('hide');
    }
});
</script>
<?php require_once '../../INCLUDES/footer.php' ?>