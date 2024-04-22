<?php  require_once '../../INCLUDES/header.php' ?>
<!-- =================================================================================================== -->


<div class="container-fluid section-title d-flex">
    <div class="s-title text-start col-6">
        <h2>By&nbsp;Session&nbsp;Metric</h2>
    </div>
    <div class="s-btn text-end col-6">
        <!-- <button type="button" class="btn btn-warning" onclick="window.location.href='../../PDF/pdf_products.php'"><img src="../../../ASSETS/IMAGES/PDF.png" class="align-middle table-img" alt=""></button>
        <button type="button" class="btn btn-success" onclick="window.location.href='category.php'">Category</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='description.php'">Description</button>
        <button type="button" class="btn btn-info" onclick="window.location.href='price.php'">Prices</button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productModal"><img src="../../../ASSETS/IMAGES/Productp.png" class="align-middle title-img" alt=""></button> -->
        <button type="button" class="btn btn-sm btn-danger" onclick="window.location.href='employees.php'">BACK</button>

    </div>
</div>
<div class="col">
    <div class="card">
        <div class="card-header">
            <caption>By&nbsp;Session&nbsp;Metric</caption>
        </div>
        <div class="card-body overflow-auto d-flex flex-wrap">


            <?php 

function displayTimeAgo($timestamp) {
    $currentTimestamp = time();
    $timeDifference = $currentTimestamp - $timestamp;

    // Define time intervals
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;
    $month = $day * 30;
    $year = $day * 365;

    // Calculate time differences
    $yearsAgo = floor($timeDifference / $year);
    $monthsAgo = floor($timeDifference / $month);
    $weeksAgo = floor($timeDifference / $week);
    $daysAgo = floor($timeDifference / $day);

    // Display result based on the largest time difference
    if ($yearsAgo > 0) {
        return $yearsAgo . ($yearsAgo == 1 ? " year ago" : " years ago");
    } elseif ($monthsAgo > 0) {
        return $monthsAgo . ($monthsAgo == 1 ? " month ago" : " months ago");
    } elseif ($weeksAgo > 0) {
        return $weeksAgo . ($weeksAgo == 1 ? " week ago" : " weeks ago");
    } elseif ($daysAgo > 0) {
        return $daysAgo . ($daysAgo == 1 ? " day ago" : " days ago");
    } elseif ($timeDifference >= $hour) {
        $hoursAgo = floor($timeDifference / $hour);
        return $hoursAgo . ($hoursAgo == 1 ? " hour ago" : " hours ago");
    } elseif ($timeDifference >= $minute) {
        $minutesAgo = floor($timeDifference / $minute);
        return $minutesAgo . ($minutesAgo == 1 ? " minute ago" : " minutes ago");
    } else {
        return "Just now";
    }
}


            $id = $_GET['id'];
            $metricDao = new MetricDao();
            $metricObj = new Metric();
            $metricObj->setEId($id);
            $getMetric = $metricDao->selectMetricByEmployee($metricObj);

            if($getMetric !== null):
                foreach($getMetric as $items){
                    $timestamp = strtotime($items['DATE_OCCURRED']);

                    // echo displayTimeAgo($timestamp);
                
                ?>

            <div class="col-lg-3 d-inline-block" style="margin-bottom:1px;height:280px;">
                <section class="card">
                    <div class="card-header user-header alt bg-dark">
                        <div class="media ">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:65px; height:65px;"
                                    alt=""
                                    src="https://images.unsplash.com/photo-1520697830682-bbb6e85e2b0b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fFNQWXxlbnwwfHwwfHx8MA%3D%3D">
                            </a>
                            <div class="media-body">
                                <h5 class="text-light display-6"><?=$items['FIRSTNAME']." ".$items['LASTNAME']?></h5>
                                <p class="text-white"><?=$items['E_ROLE']?></p>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-envelope-o"></i> Activity: <span
                                class="badge_my badge-primary "><?=$items['M_DESC']?></span>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-tasks"></i>Date:<span
                                class="badge_my badge-danger pull-right"><?=$items['DATE_OCCURRED']?></span>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-bell-o"></i> Time elapse: <span
                                class="badge_my badge-success pull-right"><?=displayTimeAgo($timestamp)?></span>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-comments-o"></i> Session&nbsp;Ref: <span
                                class="badge_my badge-warning pull-right r-activity"><?=$items['S_REF']?></span>
                        </li>
                    </ul>

                </section>
            </div>

            <?php } endif ?>





        </div>
    </div>
</div>















<!-- ==================================================================================================== -->
<?php require_once '../../INCLUDES/footer.php' ?>