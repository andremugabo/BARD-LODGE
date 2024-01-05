<?php  require_once '../../INCLUDES/header.php' ?>

<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>System Users</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-sm btn-danger "
            onclick="window.location.href='employees.php'">Back</button>
    </div>
</div>

<div class="col">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Users Table</strong>
        </div>
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Names</th>
                        <th scope="col" style="text-align: center;">Username</th>
                        <th scope="col" style="text-align: center;">User&nbsp;Password</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $user = new UsersDao();
                    $selectUsers =$user->selectUsers();
                    $num = 0;
                    // print_r($selectEmployee);
                    if ($selectUsers != null):
                    foreach ($selectUsers as $item) {  $num++;?>


                    <tr>
                        <td style="text-align: center;"><?=$num?></td>
                        <td style="text-align: center;"><?=$item['FIRSTNAME']." ".$item['LASTNAME']?></td>
                        <td style="text-align: center;"><?=$item['U_NAME']?></td>
                        <td style="text-align: center;"><?=$item['U_PASSWORD']?></td>
                        <td style="text-align: center;"><button type="button btn-sm" title="Disable user"
                                class="btn btn-danger table-btn"
                                onclick="window.location.href='../../API/Controller/UsersController.php?action=disable&e_id=<?=$item['E_ID']?>'"><img
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

<?php require_once '../../INCLUDES/footer.php' ?>