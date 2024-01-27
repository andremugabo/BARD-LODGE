<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->


<div class="principal-row justify-content-center row">





    <?php  if($employee_role =="ADMIN" || $employee_role =="IT" || $employee_role =="MANAGER" || $employee_role =="MD"): ?>

    <div class="card-principal card border-dark shadow bg-light m-2">
        <a href="dashboard.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">DASHBOARD</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-gray">
                            <i class="align-middle text-black" data-feather="airplay"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black text-black" style="font-size: 18px;">GSL-MIS&nbsp;Dashboard</h3>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>
    <?php endif ?>



    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT"): ?>

    <div class="card-principal card bg-success m-2">
        <a href="../EMPLOYEES/employees.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">EMPLOYEES</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-black">
                            <i class="align-middle text-black" data-feather="users"></i>
                        </div>
                    </div>
                </div>
                <?php 
								$employees = new EmployeesDao();
								$count = $employees->countEmployee();


								 ?>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 18px;">
                    <?=$count?>&nbsp;Employees
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php endif ?>






    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT"): ?>

    <div class="card-principal card bg-danger m-2">
        <a href="#" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">LODGE</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
                <?php

								//$categories = new categoryModel();
								//$countCategory = $categories->countCategory();	

								?>
                <h3 class="mt-1 mb-3 text-black text-black" style="font-size: 18px;">Lodge&nbsp;Dashboard
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php endif ?>

    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT"): ?>
    <div class="card-principal card bg-warning m-2">
        <a href="#" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">LIQUOR&nbsp;STORE</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="slack"></i>
                        </div>
                    </div>
                </div>
                <?php 
								
								//$types = new pTypeModel();
								//$countType  = $types->countType();

								?>
                <h3 class="mt-1 mb-3 text-black text-black" style="font-size: 15px;">Liquor&nbsp;Store&nbsp;Dashboard
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>GSL-MIS
                    </span>
                    <!-- <span class="text-black fw-bold3">SM</span> -->
                </div>
            </div>
        </a>
    </div>
    <?php endif; ?>


    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT"): ?>


    <div class="card-principal card bg-info m-2">
        <a href="../PRODUCTS/products.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title  text-black">PRODUCTS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="log-in"></i>
                        </div>
                    </div>
                </div>
                <?php 
								$products = new ProductsDao();
								$count = $products->countProduct();


								 ?>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">
                    <?=$count?>&nbsp;Products
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php endif; ?>


    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT"): ?>

    <div class="card-principal card bg-danger m-2">
        <a href="../SESSIONS/session.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">SESSIONS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="log-in"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-white" style="font-size: 10px;">
                    <?php
                        // $sessionDao = new SessionsDao();
                        // $sessionInfo = $sessionDao->selectOpenSession();
                        // $countSession = $sessionDao->checkOpenSessions();
                        // print_r($sessionInfo);
                        if($countSession == 0)
                        {
                            echo "THERE IS NO OPEN SESSION";
                        }
                        else
                        {
                            echo $sessionInfo[0]['S_REF'];
                        }
                    
                    ?>
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>


    <?php endif;?>

    <?php  if ($countSession !== 0 ):?>

    <?php if($employee_role =="MD" ||  $employee_role == "IT"): ?>

    <div class="card-principal card bg-info m-2">
        <a href="../STOCKS/gStock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">G-STOCK</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">
                    <?php
                        $gStockDao = new GStockDao();
                        $ItemArray = $gStockDao->countItem();
                        $countItem = $ItemArray['sum(p_qty)'];
                        
                        
                        if($countItem == 0)
                        {
                            echo "THERE IS NO ANY ITEM";
                        }
                        else
                        {
                            echo $countItem." items In G-Stock";
                        }
                    
                    ?>
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>
    <?php endif; ?>




    <?php if($employee_role =="MD" || $employee_role == "MANAGER" || $employee_role == "IT" || $employee_role == "ACCOUNTANT" || $employee_role == "BARMAN"): ?>


    <div class="card-principal card bg-warning m-2">
        <a href="../STOCKS/sStock.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">S-STOCK</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">
                    <?php
                        $sStockDao = new SStockDao();
                        $ItemArray = $sStockDao->countItem();
                        $countItem = $ItemArray['sum(p_qty)'];
                        
                        
                        if($countItem == 0)
                        {
                            echo "THERE IS NO ANY ITEM";
                        }
                        else
                        {
                            echo $countItem." items In S-Stock";
                        }
                    
                    ?>
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php endif; ?>



    <?php //if($employee_role =="ADMIN"){ ?>

    <div class="card-principal card bg-success m-2">
        <a href="../ORDERS/order.php" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">ORDER</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="refresh-ccw"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black" style="font-size: 15px;">
                    <?php
                        $orderDao = new OrdersDao();
                        $orderObj = new Orders();
                        $s_id = $sessionInfo[0]['S_ID'];
                        $orderObj->setSId($s_id);
                        $countItem = $orderDao->countOrderBySId($orderObj);
                        if($countItem == 0)
                        {
                            echo "THERE IS NO ORDER YET";
                        }
                        else
                        {
                            echo $countItem." ORDERS ";
                        }
                    
                    ?>
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>GSL-MIS
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php //} ?>



    <div class="card-principal card bg-primary m-2">
        <a href="#" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">EXPENSES</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-black">
                            <i class="align-middle text-black" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3  text-black">2.382</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php endif; ?>

    <?php //if($employee_role =="ADMIN"){ ?>

    <div class="card-principal card bg-secondary m-2">
        <a href="#" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">METRIC</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="download"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black">2.382</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php //} ?>


    <?php //if($employee_role =="ADMIN"){ ?>

    <!-- <div class="card-principal card bg-primary m-2">
							<a href="PRODUCTS/" style="text-decoration:none;">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h6 class="card-title text-black">SALES STOCK</h6>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="cloud-rain"></i>
										</div>
									</div>
								</div>
								<h3 class="mt-1 mb-3">2.382</h3>
								<div class="mb-0">
									<span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> SJEC-Ltd </span>
									<span class="text-black">Since last week</span>
								</div>
							</div>
							</a>
						</div> -->

    <?php //} ?>




    <div class="card-principal card bg-danger m-2">
        <a href="#" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">SETTINGS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="settings"></i>
                        </div>
                    </div>
                </div>
                <h3 class="mt-1 mb-3 text-black">2.382</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>







    <div class="card-principal card bg-info m-2">
        <a href="#" style="text-decoration:none;">
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
                <h3 class="mt-1 mb-3 text-black">2.382</h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>




    <?php //if($employee_role =="ADMIN"){ ?>

    <!-- <div class="card-principal card bg-light m-2">
							<a href="<?php //base(); ?>dashboard" style="text-decoration:none;">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h6 class="card-title text-black">DASHBOARD</h6>
									</div>

									<div class="col-auto">
										<div class="stat text-primary">
											<i class="align-middle" data-feather="watch"></i>
										</div>
									</div>
								</div>
								<h3 class="mt-1 mb-3">2.382</h3>
								<div class="mb-0">
									<span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> SJEC-Ltd </span>
									<span class="text-black">Since last week</span>
								</div>
							</div>
							</a>
						</div> -->

    <?php //} ?>







</div>













<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>