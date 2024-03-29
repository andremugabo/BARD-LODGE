<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-6">
        <h2>Reports</h2>
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
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>
    </div>
</div>

<div class="principal-row justify-content-center row">



    <?php  if ($countSession !== 0 ):?>

    <div class="card-principal card bg-info m-2">
        <a href="individualReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">REPORTS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="activity"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">Individual&nbsp;Daily&nbsp;Report</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>


    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" || $employee_role == "BARMAN"): ?>

    <div class="card-principal card bg-danger m-2">
        <a href="dailyReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">REPORTS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="flag"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">Daily&nbsp;Report</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>


    <div class="card-principal card bg-secondary m-2">
        <a href="debtReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">REPORTS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="flag"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">Order&nbsp;With&nbsp;Debt</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>


    <?php endif;?>
    <?php endif; ?>


    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT"): ?>

    <div class="card-principal card bg-warning m-2">
        <a href="generalReport.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">REPORTS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="flag"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">General&nbsp;Report</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GWC-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>
    <?php endif;?>


</div>

<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>