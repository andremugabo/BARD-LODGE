<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$o_ref = $_GET['o_ref'];
$orderDetailsDao = new OrderDetailsDao();
$orderDetails = new OrderDetails();
// $orderDao = new OrdersDao();
// $orderObj = new Orders();
// $orderObj->setORef($o_ref);
// $oInfo = $orderDao->selectOrderById($orderObj);
// $orderObj->setORef($_GET['o_ref']);
// $orderInfo = $orderDao->selectOrderById($orderObj);
$orderDetails->setOdId($_GET['od_id']);
$selectedOrder = $orderDetailsDao->selectOrderDetailsOneP($orderDetails);
// print_r($selectedOrder);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Void&nbsp;Product</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50"
            onclick="window.location.href='voidOrder.php?o_ref=<?=$_GET['o_ref']?>'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block  " style="background-color: rgba(0, 0, 0, 0.03);" tabindex="-1"
    role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Edit Category</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form action="../../API/CONTROLLER/Voided_orderController.php?action=insert" method="post">

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">PRODUCT</label>
                        <input id="p_name" name="p_name" type="text" value="<?=$selectedOrder['P_NAME']?>" disabled
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">O_REF</label>
                        <input id="p_name" name="o_ref" type="text" value="<?=$selectedOrder['O_REF']?>"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">E_ID</label>
                        <input id="p_pprice" name="e_id" type="text" value="<?=$selectedOrder['E_ID']?>"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">O_ID</label>
                        <input id="p_pprice" name="o_id" type="text" value="<?=$selectedOrder['O_ID']?>"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">OD_ID</label>
                        <input id="p_pprice" name="od_id" type="text" value="<?=$selectedOrder['OD_ID']?>"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>


                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">P_ID</label>
                        <input id="p_pprice" name="p_id" type="text" value="<?=$selectedOrder['P_ID']?>"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">E_ID</label>
                        <input id="p_pprice" name="unity_id" type="text" value="<?=$selectedOrder['UNITY_ID']?>"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">SERVED BY</label>
                        <input id="p_sprice" type="text" value="<?=$selectedOrder['FIRSTNAME']?>" disabled
                            class="form-control" required>
                    </div> -->

                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">SELLING PRICE</label>
                        <input id="p_sprice" name="p_sprice" type="text" value="${result[0].SPRICE}"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">PRODUCT&nbsp;UNITY</label>
                        <input id="p_name" name="unity_name" type="text" value="<?=$selectedOrder['UNITY_NAME']?>"
                            disabled class="form-control" required>
                    </div>

                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">PRODUCT</label>
                        <input id="unity_id" name="unity_id" type="text" value="<?=$selectedOrder['UNITY_ID']?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">CURRENT&nbsp;QUANTITY</label>
                        <input name="" type="text" value="<?=$selectedOrder['P_QTY']?>" class="form-control" disabled>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="cc-payment" class="control-label mb-1">CURRENT&nbsp;QUANTITY</label>
                        <input name="p_qty" type="text" value="<?=$selectedOrder['P_QTY']?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">QUANTITY</label>
                        <input name="new_qty" type="number" value="" placeholder="ENTER QUANTITY" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">REASON</label>
                        <input name="v_reason" type="text" class="form-control" placeholder="ENTER REASON" required>
                    </div>

                    <button class="w-50 m-2 btn btn-lg rounded-4 btn-info btn-sm" type="submit"
                        name="voidProduct">Void&nbsp;Product</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>