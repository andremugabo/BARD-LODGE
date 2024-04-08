<?php  require_once '../../INCLUDES/header.php' ?>
<?php
$sessionDao = new SessionsDao();
// require_once '../../API/MODEL/Prices.php';
$sessionObj = new Sessions();
$s_id = $_GET['close'];
$sessionObj->setSId($s_id);
// echo $e_id;
$selectById = $sessionDao->selectSessionBySid($sessionObj);
// print_r($selectById);

?>
<div class="container-fluid section-title d-flex mb-2">
    <div class="s-title text-start col-5">
        <h2>Close Session</h2>
    </div>
    <div class="s-btn text-end col-7">
        <button type="button" class="btn btn-danger w-50" onclick="window.location.href='session.php'">Cancel</button>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="modal modal-signin position-static d-block  " style="background-color: rgba(0, 0, 0, 0.03);" tabindex="-1"
    role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0" style="font-size: 15px;">Are Sure You Want to Close the Current Session?</h2>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="" action="../../API/CONTROLLER/SessionsController.php?action=close" method="post">
                    <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['S_ID']?>" name="s_id"
                            placeholder="s_id">
                        <label for="floatingInput">s_id</label>
                    </div>

                    <!-- <div class="form-floating mb-3" style="display:none;">
                        <input type="text" class="form-control rounded-4" value="<?=$selectById['P_ID']?>" name="p_id"
                            placeholder="P_ID">
                        <label for="floatingInput">p_id</label>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="p_type" class="col-form-label">Products&nbsp;Type:</label>
                        <select class="form-select form-select mb-3" id="type" name="p_type"
                            aria-label=".form-select-lg example" onchange="getCategory(this.value)" required>
                            <option selected disabled value="">Choose&nbsp;Product&nbsp;Type</option>
                            <?php 
                                $typeDaoObj = new productCategoryDao();
                                $selectType = $typeDaoObj->selectproductCategory();
                                if($selectType != null):
                                    foreach($selectType as $item){ ?>
                            <option value="<?=$item['PT_ID']?>"><?=$item['PT_NAME'];?></option>

                            <?php }?>
                            <?php endif?>

                        </select>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Products&nbsp;Category:</label>
                        <select class="form-select form-select mb-3" id="category" name="pc_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value=""><?=$selectById['PT_NAME']?></option>

                        </select>
                    </div> -->

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Current&nbsp;Session:</label>
                        <input type="text" class="form-control" name="s_ref" id="pc_name"
                            value="<?=$selectById['S_REF']?>" placeholder="Enter Product" required>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="role" class="col-form-label">Product&nbsp;Unity:</label>
                        <select class="form-select form-select mb-3" id="unity" name="unity_id"
                            aria-label=".form-select-lg example" required>
                            <option selected disabled value=""><?=$selectById['UNITY_NAME']?></option>
                            <?php 
                                $unityDaoObj = new UnityDao();
                                $selectUnity = $unityDaoObj->selectUnity();
                                print_r($selectUnity);
                                if($selectUnity != null):
                                    foreach($selectUnity as $item){
                            ?>
                            <option value="<?=$item['UNITY_ID']?>"><?=$item['UNITY_NAME']?></option>
                            <?php }  endif?>

                        </select>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="p_name" class="col-form-label">Purchase&nbsp;Price:</label>
                        <input type="text" class="form-control" name="pprice" id="pprice"
                            placeholder="ENTER PURCHASE PRICE" value="<?=$selectById['PPRICE']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Selling&nbsp;Price:</label>
                        <input type="text" class="form-control" name="sprice" id="sprice"
                            placeholder="ENTER SELLING PRICE" value="<?=$selectById['SPRICE']?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="p_name" class="col-form-label">Special&nbsp;Price:</label>
                        <input type="text" class="form-control" name="eprice" id="eprice"
                            placeholder="ENTER SPECIAL PRICE" value="<?=$selectById['EPRICE']?>" required>
                    </div> -->






                    <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary close_s" type="submit"
                        name="closeSession">Close&nbsp;Session</button>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="closing_session hide">
    <h1>WAIT... SESSION IS CLOSING...</h1>
    <img src="../../ASSETS/SIMAGES/loading-loader.gif" alt="Loading..." />
</div>
<script>
document.querySelector(".close_s").addEventListener("click", function() {
    // e.preventDefault();
    document.querySelector(".closing_session").classList.remove("hide");
    setTimeout(() => {
        document.querySelector(".closing_session").classList.add('hide');
    }, 50000);
});
</script>
<?php require_once '../../INCLUDES/footer.php' ?>