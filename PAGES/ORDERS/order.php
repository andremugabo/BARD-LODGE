<?php  require_once '../../INCLUDES/header.php' ?>
<div class="msg">
</div>


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-3">
        <h2>Daily&nbsp;Orders</h2>
    </div>



    <div class="s-btn text-end col-9">
        <!-- <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button> -->
        <button type="button" class="btn btn-info"
            onclick="window.location.href='allOrders.php'">All&nbsp;Daily&nbsp;Orders</button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
            data-bs-target="#orderModal">Create&nbsp;A&nbsp;New&nbsp;Order</button>
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>

    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">List of Registered Daily Orders</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table align-middle mb-0 bg-white table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <!-- <th scope="col" style="text-align: center;">Subsession&nbsp;Entry&nbsp;Point</th> -->
                        <th scope="col" style="text-align: center;">Order&nbsp;Reference</th>
                        <th scope="col" style="text-align: center;">Placed&nbsp;By</th>
                        <th scope="col" style="text-align: center;">Date</th>
                        <th scope="col" style="text-align: center;">Payment&nbsp;Status</th>
                        <th scope="col" style="text-align: center;">Total&nbsp;Amount</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td style="text-align: center;">1</td>
                        <!-- <td style="text-align: center;">subSession/15-01-2024/0007</td> -->
                        <td style="text-align: center;">O-0171</td>
                        <td style="text-align: center;">MUGABO Andre</td>
                        <td style="text-align: center;">2024-01-15</td>
                        <td style="text-align: center;">NOT PAID</td>
                        <td style="text-align: center;">0</td>
                        <td style="text-align: center;"><button type="button" class="btn btn-success table-btn"
                                onclick="window.location.href='orderDetails.php?o_ref=O-0171'"><img
                                    src="../../../../ASSETS/IMAGES/Buy.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-info table-btn"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=O-0171'"><img
                                    src="../../../../ASSETS/IMAGES/View.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button"
                                onclick="window.location.href='voidOrder.php?o_ref=O-0171'"
                                class="btn btn-warning table-btn"><img src="../../../../ASSETS/IMAGES/ReturnP.png"
                                    class="align-middle table-img" alt=""></button></td>
                    </tr>




                    <tr>
                        <td style="text-align: center;">2</td>
                        <!-- <td style="text-align: center;">subSession/14-03-2022/0006</td> -->
                        <td style="text-align: center;">O-0170</td>
                        <td style="text-align: center;">MUGABO Andre</td>
                        <td style="text-align: center;">2022-03-14</td>
                        <td style="text-align: center;">NOT PAID</td>
                        <td style="text-align: center;">0</td>
                        <td style="text-align: center;"><button type="button" class="btn btn-success table-btn"
                                onclick="window.location.href='orderDetails.php?o_ref=O-0170'" style="display:none"><img
                                    src="../../../../ASSETS/IMAGES/Buy.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-info table-btn"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=O-0170'"><img
                                    src="../../../../ASSETS/IMAGES/View.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button"
                                onclick="window.location.href='voidOrder.php?o_ref=O-0170'"
                                class="btn btn-warning table-btn" style="display:none"><img
                                    src="../../../../ASSETS/IMAGES/ReturnP.png" class="align-middle table-img"
                                    alt=""></button></td>
                    </tr>




                    <tr>
                        <td style="text-align: center;">3</td>
                        <!-- <td style="text-align: center;">subSession/14-03-2022/0006</td> -->
                        <td style="text-align: center;">O-0167</td>
                        <td style="text-align: center;">MUGABO Andre</td>
                        <td style="text-align: center;">2022-03-14</td>
                        <td style="text-align: center;">NOT PAID</td>
                        <td style="text-align: center;">0</td>
                        <td style="text-align: center;"><button type="button" class="btn btn-success table-btn"
                                onclick="window.location.href='orderDetails.php?o_ref=O-0167'" style="display:none"><img
                                    src="../../../../ASSETS/IMAGES/Buy.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-info table-btn"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=O-0167'"><img
                                    src="../../../../ASSETS/IMAGES/View.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button"
                                onclick="window.location.href='voidOrder.php?o_ref=O-0167'"
                                class="btn btn-warning table-btn" style="display:none"><img
                                    src="../../../../ASSETS/IMAGES/ReturnP.png" class="align-middle table-img"
                                    alt=""></button></td>
                    </tr>




                    <tr>
                        <td style="text-align: center;">4</td>
                        <!-- <td style="text-align: center;">subSession/13-03-2022/0005</td> -->
                        <td style="text-align: center;">O-0165</td>
                        <td style="text-align: center;">HABIYAMBERE Celestin</td>
                        <td style="text-align: center;">2022-03-13</td>
                        <td style="text-align: center;">NOT PAID</td>
                        <td style="text-align: center;">0</td>
                        <td style="text-align: center;"><button type="button" class="btn btn-success table-btn"
                                onclick="window.location.href='orderDetails.php?o_ref=O-0165'" style="display:none"><img
                                    src="../../../../ASSETS/IMAGES/Buy.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-info table-btn"
                                onclick="window.location.href='viewOrderDetails.php?o_ref=O-0165'"><img
                                    src="../../../../ASSETS/IMAGES/View.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button"
                                onclick="window.location.href='voidOrder.php?o_ref=O-0165'"
                                class="btn btn-warning table-btn" style="display:none"><img
                                    src="../../../../ASSETS/IMAGES/ReturnP.png" class="align-middle table-img"
                                    alt=""></button></td>
                    </tr>




                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- =================================================
                              INSERT MODAL
      ======================================================= -->

<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create&nbsp;Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="product_create" action="../../../../API/CONTROLER/ordersControler.php?action=insert&sub_id=36"
                    method="POST">

                    <div class="message_login mb-3 ">

                    </div>

                    <button type="submit" name="CreateOrder" class="btn btn-danger w-100">Create&nbsp;Order</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<?php require_once '../../INCLUDES/footer.php' ?>