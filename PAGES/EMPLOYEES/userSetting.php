<?php  require_once '../../INCLUDES/header.php' ?>
<div class="container-fluid p-0">

    <div class="container-fluid section-title d-flex mb-2">
        <div class="s-title text-start col-6">
            <h2>Settings</h2>
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

    <div class="row">

        <div class="col-md-3 col-xl-2 pt-3 mb-5" style="background: linear-gradient(270deg, #403f3f, #222e3c78)">

            <div class="card " style="background: #222e3c;">
                <div class="card-header">
                    <h5 class="card-title text-white mb-0">Profile Settings</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist" style="background: #222e3c;">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account"
                        role="tab">
                        Account
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        Password
                    </a>

                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    <div class="card" style="background: linear-gradient(270deg, #403f3f, #222e3c78)">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Users info</h5>
                        </div>
                        <div class="card-body">
                            <form action="../../../API/CONTROLER/usersControler.php?action=updateusername"
                                method="POST">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Username</label>
                                            <input type="text" class="form-control" value="<?=$employee_phone?>"
                                                name="current&nbsp;UserName" disabled id="inputUsername">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-white">Update&nbsp;UserName</label>
                                            <input class="form-control" type="text" name="username"
                                                placeholder="UpdateUserName" required />
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit" name="updateUsername"
                                        class="btn  btn-warning w-100 fs-5">Update&nbsp;UserName</button>
                                </div>
                            </form>

                        </div>
                    </div>


                </div>
                <div class="tab-pane fade " id="password" role="tabpanel">
                    <div class="card" style="background: linear-gradient(270deg, #403f3f, #222e3c78)">
                        <div class="card-body">
                            <h5 class="card-title">Password</h5>

                            <form action="../../../API/CONTROLER/usersControler.php?action=updatepassword"
                                method="POST">
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                    <input type="password" name="Currentpassword" class="form-control"
                                        id="inputPasswordCurrent">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordNew">New password</label>
                                    <input type="password" name="Newpassword" class="form-control" id="inputPasswordNew"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordNew2">Confirm&nbsp;Password</label>
                                    <input type="password" name="ConfirmPassword" class="form-control"
                                        id="inputPasswordNew2" required>
                                </div>
                                <div class="text-center mt-2">
                                    <button type="submit" name="updatePassword"
                                        class="btn  btn-warning w-100 fs-5">Update&nbsp;Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php require_once '../../INCLUDES/footer.php' ?>