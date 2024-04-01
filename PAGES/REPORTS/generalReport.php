<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2>General&nbsp;Reports</h2>
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
        <button type="button" class="btn btn-sm btn-danger " onclick="window.location.href='report.php'">Back</button>
    </div>
</div>

<div class="principal-row justify-content-center row">
    <div class="card-principal card border-dark shadow bg-light m-2">
        <a href="purchasedReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">Purchased&nbsp;Report</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <div class="card-principal card border-dark shadow bg-info m-2">
        <a href="receivedReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">Sales&nbsp;Received</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <div class="card-principal card border-dark shadow bg-warning m-2">
        <a href="salesReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">Sales&nbsp;Report</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <div class="card-principal card border-dark shadow bg-primary m-2">
        <a href="orderReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">Orders&nbsp;Report</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>


    <!-- <div class="card-principal card border-dark shadow bg-danger m-2">
        <a href="creditsOrdersReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">Credit&nbsp;Orders</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                </div>
            </div>
        </a>
    </div> -->

    <div class="card-principal card border-dark shadow bg-success m-2">
        <a href="gStock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">Current&nbsp;MStock</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>


    <div class="card-principal card border-dark shadow bg-dark m-2">
        <a href="sStock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-white">Current&nbsp;SStock</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <div class="card-principal card border-dark shadow bg-info m-2">
        <a href="closedSalesStock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-white">Closed&nbsp;SStock</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>



    <div class="card-principal card border-dark shadow bg-secondary m-2">
        <a href="closedGstock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-white">Closed&nbsp;MStock</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <div class="card-principal card border-dark shadow bg-warning m-2">
        <a href="globalStock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-white">General&nbsp;Stock</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>






</div>

<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>