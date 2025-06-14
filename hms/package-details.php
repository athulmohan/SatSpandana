<?php
$countVal = "select * from packages where LOWER(specialization) = '".strtolower($packageParam)."' order by specialization;";
$countQuery = mysqli_query($con, $countVal);
$countSql=mysqli_num_rows($countQuery);


$sql = "select * from packages order by specialization;";
$packageSql = mysqli_query($con, $sql);
$rowcount = mysqli_num_rows( $packageSql );
$ind = 0;
$tbCls = "knee-dataTable";
$specialization = '';
// echo $packageParam;die;
while($package=mysqli_fetch_assoc($packageSql)) {
    $ind++;
    if($ind % 2 === 0){
        $tbCls = "spinal-dataTable";
    } else {
        $tbCls = "knee-dataTable";
    }
    $sql = 'select * from packagedetails where package_id = "'.$package['id'].'"';
    $packageDetailsSql = mysqli_query($con, $sql);
    $modalId = "packageModal" . $ind;

    $package_modal_tb_additional_style = (($ind % 2) == 0) ? 'package-modal-tb-even' : 'package-modal-tb-odd';
?>
    <?php
    include_once('service-details.php');
    if(strtolower($packageParam) === strtolower($package['specialization']) || strtolower($packageParam) === 'all') {

        if($specialization !== $package['specialization']) { ?>
            <div class="mt-3 inner-title">
                <h3>Available Packages</h3>
                <p>Take a look at some of our key <?php echo $package['specialization']; ?> Packages</p>
            </div>
        <?php } ?>
        <div class="<?php echo $package_modal_tb_additional_style; ?> <?php //echo strtolower($package['specialization']); ?>-bg-img-<?php echo $ind; ?>"> <!-- package-bg-img -->
            <div class="package-details-list">
                <div class="content-bg-layer">
                    <div id="therapy" class="container therapy py-5">
                        <hr>
                        </hr>
                        <div class="text">* <?php echo $package['treatmentName']; ?></div>
                        <hr>
                        </hr>
                        <p><?php echo $package['description']; ?></p>

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                            View Package Details
                        </button>

                        <!-- Modal -->
                        <div class="modal fade modal-package-details" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content <?php echo $package_modal_tb_additional_style; ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Package Details - <?php echo $package['treatmentName']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body"> <!-- class="mt-5" -->
                                        <div class="table-responsive"> <!-- col-md-12  style="overflow-x:auto;" -->
                                            <table id="<?php echo $tbCls; ?>" class="table table-striped physio-dataTable" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Package Name</th>
                                                        <th>No of Days</th>
                                                        <th>Without Accommodation</th>
                                                        <th>Single Occupancy</th>
                                                        <th>Double Occupancy</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    while($packageDetails=mysqli_fetch_assoc($packageDetailsSql)) { 
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $packageDetails['packageName'] ?></td>
                                                            <td><?php echo $packageDetails['days'] ?></td>
                                                            <td><?php echo $packageDetails['without'] ?></td>
                                                            <td><?php echo $packageDetails['singleOccupancy'] ?></td>
                                                            <td><?php echo $packageDetails['doubleOccupancy'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        if($ind === 1) {
            if($packageParam === '' || $packageParam === 'Invalid') {
            ?>
                <section id="no-package" class="no-package mt-5">
                    <div class="container-fluid">
                        <div class="inner-title">
                            <h3>Invalid Package Code ...</h3>
                            <p>Please Contact Administator</p>
                        </div>
                    </div>
                </section>
            <?php } 
            else if($countSql === 0 || $rowcount === 0 || ($rowcount === 0 && $packageParam !== '')) {
            ?>
                <section id="no-package" class="no-package mt-5">
                    <div class="container-fluid">
                        <div class="inner-title">
                            <h3>No Packages Available ...</h3>
                            <p>More packages are in the queue.</p>
                        </div>
                    </div>
                </section>
            <?php } else { ?>
            <!-- <section id="no-package" class="no-package mt-5">
                <div class="container-fluid">
                    <div class="inner-title">
                        <h3>No Packages Available ...</h3>
                        <p>More packages are in the queue.</p>
                    </div>
                </div>
            </section> -->
           <?php } 
        }
    }
    $specialization = $package['specialization'];
} ?>