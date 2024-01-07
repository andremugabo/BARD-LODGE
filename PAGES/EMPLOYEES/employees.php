<?php  require_once '../../INCLUDES/header.php' ?>

<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Employee</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='users.php'">Users</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
            data-bs-target="#employeeModal">Create&nbsp;Employee</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>
    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Employees Table</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Reg-Number</th>
                        <th scope="col" style="text-align: center;">Names</th>
                        <th scope="col" style="text-align: center;">Role</th>
                        <th scope="col" style="text-align: center;">Phone</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $employee = new EmployeesDao();
                    $selectEmployee =$employee->selectEmployee();
                    $num = 0;
                    // print_r($selectEmployee);
                    if ($selectEmployee != null):
                    foreach ($selectEmployee as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['E_REGNUMBER']?></td>
                        <td style="text-align: center;"><?=$item['FIRSTNAME']." ".$item['LASTNAME']?></td>
                        <td style="text-align: center;"><?=$item['E_ROLE']?></td>
                        <td style="text-align: center;"><?=$item['E_PHONE']?></td>
                        <td style="text-align: center;"><button type="button btn-sm" title="Edit Employee Info"
                                class="btn btn-primary table-btn"
                                onclick="window.location.href='editEmployee.php?edit=<?=$item['E_ID']?>'"><img
                                    src="../../ASSETS/SIMAGES/EditU.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button btn-sm"
                                title="Allow employee to use the system" class="btn btn-success table-btn"
                                onclick="window.location.href='../../API/CONTROLlER/usersController.php?action=insert&e_id=<?=$item['E_ID']?>'"><img
                                    src="../../ASSETS/SIMAGES/AddUM.png" class="align-middle table-img" alt=""></button>
                        </td>
                    </tr>


                    <?php 
                            }
                        endif;
                     ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- =================================================
                              INSERT MODAL
      ======================================================= -->


<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add&nbsp;New&nbsp;Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../../API/CONTROLLER/employeesController.php?action=insert" method="POST">
                    <div class="mb-3">
                        <label for="firstname" class="col-form-label">Firstname:</label>
                        <input type="text" class="form-control" name="firstname" id="firstname"
                            placeholder="ENTER FIRSTNAME" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="col-form-label">Lastname:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname"
                            placeholder="ENTER LASTNAME" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Employee&nbsp;Role:</label>
                        <select class="form-select form-select mb-3" id="role" name="e_role"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;Employee&nbsp;Role</option>
                            <option value="MANAGER">MANAGER</option>
                            <option value="ACCOUNTANT">ACCOUNTANT</option>
                            <option value="BARMAN">BARMAN</option>
                            <option value="CHEF">CHEF</option>
                            <option value="WAITER">WAITER</option>
                            <option value="CLEANER">CLEANER</option>
                            <option value="SECURITY GUARD">SECURITY&nbsp;GUARD</option>
                            <option value="RECEPTIONIST">RECEPTIONIST</option>
                            <option value="TOKENMAN">TOKEN&nbsp;MAN</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="col-form-label">Employee&nbsp;ID&nbsp;Number:</label>
                        <input type="text" class="form-control" name="e_idnumber" id="e_idnumber"
                            placeholder="ENTER  A VALID NATIONAL ID NUMBER" required>
                    </div>


                    <div class="mb-3">
                        <label for="phone" class="col-form-label">Employee&nbsp;Phone:</label>
                        <input type="text" class="form-control" name="e_phone" id="phone"
                            placeholder="ENTER PHONE NUMBER" required>
                    </div>
                    <div class="message_login mb-3 ">

                    </div>

                    <button type="submit" name="addEmployee" class="btn btn-primary">Add&nbsp;Employee</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>