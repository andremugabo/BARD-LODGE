<?php  require_once '../../INCLUDES/header.php' ?>

<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Sessions</h2>
    </div>
    <div class="s-btn text-end col-7">
        <!-- <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='users.php'">Users</button>
        &nbsp; -->
        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
            data-bs-target="#sessionModal">Create&nbsp;Session</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='../DASHBOARD/'">Back</button>
    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">sessions Table</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Session&nbsp;Reference</th>
                        <th scope="col" style="text-align: center;">Created&nbsp;On</th>
                        <th scope="col" style="text-align: center;">Status</th>
                        <!-- <th scope="col" style="text-align: center;">Phone</th> -->
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $session = new sessionsDao();
                    $selectSession =$session->selectOpenSession();
                    $num = 0;
                    // print_r($selectSession);
                    if ($selectSession != null):
                    foreach ($selectSession as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['S_REF']?></td>
                        <td style="text-align: center;"><?=$item['DATEOCCURRED']?></td>
                        <td style="text-align: center;"><?=$item['S_STATUS']?></td>
                        <td style="text-align: center;"><button type="button btn-sm" title="Close session"
                                class="btn btn-danger table-btn"
                                onclick="window.location.href='closeSession.php?close=<?=$item['S_ID']?>'"><img
                                    src="../../ASSETS/SIMAGES/Cancel 2_20px_1.png" class="align-middle table-img"
                                    alt=""></button>
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


<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add&nbsp;New&nbsp;session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../../API/CONTROLLER/SessionsController.php?action=insert" method="POST">
                    <!-- <div class="mb-3">
                        <label for="firstname" class="col-form-label">Firstname:</label>
                        <input type="text" class="form-control" name="firstname" id="firstname"
                            placeholder="ENTER FIRSTNAME" required>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="lastname" class="col-form-label">Lastname:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname"
                            placeholder="ENTER LASTNAME" required>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">session&nbsp;Role:</label>
                        <select class="form-select form-select mb-3" id="role" name="e_role"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value="">Choose&nbsp;session&nbsp;Role</option>
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
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="email" class="col-form-label">session&nbsp;ID&nbsp;Number:</label>
                        <input type="text" class="form-control" name="e_idnumber" id="e_idnumber"
                            placeholder="ENTER  A VALID NATIONAL ID NUMBER" required>
                    </div> -->


                    <!-- <div class="mb-3">
                        <label for="phone" class="col-form-label">session&nbsp;Phone:</label>
                        <input type="text" class="form-control" name="e_phone" id="phone"
                            placeholder="ENTER PHONE NUMBER" required>
                    </div> -->
                    <!-- <div class="message_login mb-3 ">

                    </div> -->

                    <button type="submit" name="addSession" class="btn btn-danger w-100">Open&nbsp;Session</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<?php require_once '../../INCLUDES/footer.php' ?>