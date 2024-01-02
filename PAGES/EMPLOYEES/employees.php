<div class="col-lg">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Employees Table</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Reg-Number</th>
                        <th scope="col" style="text-align: center;">Names</th>
                        <th scope="col" style="text-align: center;">Role</th>
                        <th scope="col" style="text-align: center;">Email</th>
                        <th scope="col" style="text-align: center;">Phone</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $num = 0;
                    //foreach ($employee->selectActive() as $employees) {  $num++; ?>


                    <tr>
                        <td style="text-align: center;">num</td>
                        <td style="text-align: center;">reg</td>
                        <td style="text-align: center;">name</td>
                        <td style="text-align: center;">role</td>
                        <td style="text-align: center;">email</td>
                        <td style="text-align: center;">phone</td>
                        <td style="text-align: center;"><button type="button btn-sm" class="btn btn-primary table-btn"
                                onclick="window.location.href=''+<?=base()?>+'editEmployee?edit=1'"><img
                                    src="../../../ASSETS/IMAGES/EditU.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-success table-btn"
                                onclick="window.location.href='../../../API/CONTROLER/usersControler.php?action=insert&e_id=1'"><img
                                    src="../../../ASSETS/IMAGES/AddUM.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-info table-btn"><img
                                    src="../../../ASSETS/IMAGES/View.png" class="align-middle table-img"
                                    alt=""></button>&nbsp;<button type="button" class="btn btn-danger table-btn"><img
                                    src="../../../ASSETS/IMAGES/Trash.png" class="align-middle table-img"
                                    alt=""></button></td>
                    </tr>


                    <?php //} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>