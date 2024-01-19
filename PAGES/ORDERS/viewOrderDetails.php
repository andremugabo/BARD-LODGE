<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2 style="color:#0dcaf0;">Order&nbsp;Details&nbsp;View</h2>
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
        <button type="button" class="btn btn-sm btn-info " onclick="window.location.href='order.php'">Back</button>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Basic Table</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                                <p>Ref : O-0170</p>
                                <p>Waiter :MUGABO Andre</p>
                            </div>
                            <div class="col-6 justify-content-end">
                                <p>Session :&nbsp;<b>VIP</b></p>
                                <p>Date: 2022-03-14 </p>
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
                                    <tr>
                                        <td style="text-align: center;">1</td>
                                        <td style="text-align: center;">MUTZING 65CL</td>
                                        <td style="text-align: center;">Btl</td>
                                        <td style="text-align: center;">4</td>
                                        <td style="text-align: center;">1300Frw</td>
                                        <td style="text-align: center;">5200Frw</td>
                                    </tr>



                                    <tr>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">PRIMUS 65CL</td>
                                        <td style="text-align: center;">Btl</td>
                                        <td style="text-align: center;">2</td>
                                        <td style="text-align: center;">1000Frw</td>
                                        <td style="text-align: center;">2000Frw</td>
                                    </tr>



                                    <tr style='background:darkred; color: white;font-weight: bold;'>
                                        <td colspan="5" style="text-align: left;">TOTAL:</td>
                                        <td style="text-align: center;">7200Frw</td>
                                    </tr>


                                </tbody>


                            </table>
                            <div class="p-1">
                                <button type="submit" name="PlaceOrder" class="btn btn-info "
                                    onclick="window.location.href='../../../PDF/pdf_order.php?ref=O-0170'">Print</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php require_once '../../INCLUDES/footer.php' ?>