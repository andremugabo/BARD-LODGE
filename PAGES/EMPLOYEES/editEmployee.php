<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$employeesDao = new EmployeesDao();
require_once '../../API/MODEL/Employees.php';
$employees = new Employees();
$e_id = $_GET['edit'];
$employees->setEId($e_id);
// echo $e_id;
$selectById = $employeesDao->getEmployeeById($employees);
// print_r($selectById['E_ID']);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Edit Employee</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50" onclick="window.location.href='employees.php'">Back</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block bg-dark " tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Edit Employee</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/EmployeesController.php?action=edit" method="post">
                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['E_ID']?>" name="e_id"
                            placeholder="e_id">
                        <label for="floatingInput">e_id</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="Lastname"
                            value="<?=$selectById['LASTNAME']?>" placeholder="Enter Lastname" required>
                        <label for="floatingInput">Lastname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="Firstname"
                            value="<?=$selectById['FIRSTNAME']?>" placeholder="Enter Firstname" required>
                        <label for="floatingInput">Firstname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select form-select mb-3" name="e_role" aria-label=".form-select-lg"
                            required>
                            <option selected disabled value=""><?=$selectById['E_ROLE']?></option>
                            <option value="MANAGER">MANAGER</option>
                            <option value="CASHIER">CASHIER</option>
                            <option value="CHEF">CHEF</option>
                            <option value="WAITER">WAITER</option>
                        </select>
                        <label for="floatingInput">Employee Role</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="e_phone"
                            value="<?=$selectById['E_PHONE']?>" placeholder="Enter Employee Phone" required>
                        <label for="floatingPassword">Employee Phone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="e_idnumber"
                            value="<?=$selectById['E_IDNUMBER']?>" placeholder="Enter Employee Phone" required>
                        <label for="floatingPassword">Employee ID Number</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit"
                        name="editEmployee">Edit&nbsp;Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>