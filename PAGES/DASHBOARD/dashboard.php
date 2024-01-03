<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->





<div class="msg">
    <?php 
				if (isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])) {?>
    <h3 style="background: #0fdd1d7a;padding: 5px;width: 100%;text-align: center;">
        <?= $_SESSION['success_msg'] ?></h3>
    <?php  $_SESSION['success_msg']="";  }else if(isset($_SESSION['fail_msg']) && !empty($_SESSION['fail_msg'])){?>
    <h3 style="background: #b71c1c8f;padding: 5px;width: 100%;text-align: center;">
        <?= $_SESSION['fail_msg'] ?></h3>
    <?php $_SESSION['fail_msg']="";	}			
			 ?>
</div>


<div class="principal-row justify-content-center row">





    <?php // if($employee_role =="ADMIN"){ ?>

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
                <h3 class="mt-1 mb-3 text-black fs-5 text-black">PUB-SM&nbsp;Dashboard</h3>
                <div class="mb-0">
                    <span class="text-black"> <i class="mdi mdi-arrow-bottom-right"></i> PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>
    <?php //} ?>



    <?php if($employee_role =="ADMIN" || $employee_role == "MANAGER"){ ?>

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
								//$users = new usersModel();
								//$count = $users->countUsers();


								 ?>
                <h3 class="mt-1 mb-3 text-black">
                    <?//=$count?>&nbsp;Employees
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php } ?>






    <?php //if($employee_role =="ADMIN"){ ?>

    <div class="card-principal card bg-danger m-2">
        <a href="category" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">CATEGORIES</h6>
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
                <h3 class="mt-1 mb-3 text-black fs-2">
                    <?//= $countCategory ." "."Categories"?>
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i> PUB-SM
                    </span>
                    <!-- <span class="text-black">Since last week</span> -->
                </div>
            </div>
        </a>
    </div>

    <?php //} ?>


    <div class="card-principal card bg-warning m-2">
        <a href="types" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">TYPES</h6>
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
                <h3 class="mt-1 mb-3 text-black fs-2">
                    <?//= $countType." "."Types"?>
                </h3>
                <div class="mb-0">
                    <span class="text-white"> <i class="mdi mdi-arrow-bottom-right"></i>PUB-SM
                    </span>
                    <!-- <span class="text-black fw-bold3">SM</span> -->
                </div>
            </div>
        </a>
    </div>


    <?php ///if($employee_role =="ADMIN"){ ?>

    <div class="card-principal card bg-info m-2">
        <a href="products" style="text-decoration:none;">
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
								//$productsActiveNumbers = new productsModel();
								//$number = $productsActiveNumbers->countProductsActive();

								?>
                <h3 class="mt-1 mb-3 text-black fs-2">
                    <? //=$number." "."Items"?>
                </h3>
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

    <div class="card-principal card bg-danger m-2">
        <a href="price" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">PRICE</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="log-in"></i>
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

    <?php //} ?>



    <div class="card-principal card bg-info m-2">
        <a href="sessions" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">SESSIONS</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="shopping-cart"></i>
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






    <div class="card-principal card bg-warning m-2">
        <a href="#" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">PURCHASES</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="shopping-cart"></i>
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




    <?php //if($employee_role =="ADMIN"){ ?>

    <div class="card-principal card bg-success m-2">
        <a href="stock" style="text-decoration:none;">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h6 class="card-title text-black">STOCK</h6>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle text-black" data-feather="refresh-ccw"></i>
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

    <?php //} ?>



    <div class="card-principal card bg-primary m-2">
        <a href="expense" style="text-decoration:none;">
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



    <?php //if($employee_role =="ADMIN"){ ?>

    <div class="card-principal card bg-secondary m-2">
        <a href="metric" style="text-decoration:none;">
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
        <a href="settings" style="text-decoration:none;">
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
        <a href="reports" style="text-decoration:none;">
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
<?php // require_once '../../INCLUDES/footer.php' ?>