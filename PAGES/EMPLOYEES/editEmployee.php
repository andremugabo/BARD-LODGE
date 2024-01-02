<?php  // Get the full URL
$currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to get the query string
$urlParts = parse_url($currentUrl);
$queryString = isset($urlParts['query']) ? $urlParts['query'] : '';

// Parse the query string into an associative array
parse_str($queryString, $queryParams);

// Access specific query parameters
$logoutValue = isset($queryParams['edit']) ? $queryParams['edit'] : '';
// echo $logoutValue;
// echo "Query String: $queryString<br>";
// echo "Logout Value: $logoutValue";
?>

<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Edit Employee</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-success w-50"
            onclick="window.location.href='<?=base()?>home'">Back</button>
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
                <form class="" action="<?=base();?>usersController?action=edit" method="post">
                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$e_id?>" name="e_id"
                            placeholder="e_id">
                        <label for="floatingInput">e_id</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="e_names"
                            value="<?=$editEmployee['e_names']?>" placeholder="Enter Names" required>
                        <label for="floatingInput">Enter Employee Names</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select form-select mb-3" name="e_role" aria-label=".form-select-lg"
                            required>
                            <option selected disabled value=""><?=$editEmployee['e_role']?></option>
                            <option value="MANAGER">MANAGER</option>
                            <option value="CASHIER">CASHIER</option>
                            <option value="CHEF">CHEF</option>
                            <option value="WAITER">WAITER</option>
                        </select>
                        <label for="floatingInput">Employee Role</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-4" name="e_email"
                            value="<?=$editEmployee['e_email']?>" placeholder="Enter a Valid Email" required>
                        <label for="floatingInput">Employee Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-4" name="e_phone"
                            value="<?=$editEmployee['e_phone']?>" placeholder="Enter Employee Phone" required>
                        <label for="floatingPassword">Employee Phone</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit"
                        name="editEmployee">Edit&nbsp;Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>