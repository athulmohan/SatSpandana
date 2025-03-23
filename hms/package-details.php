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
        <div class="package-bg-img <?php echo strtolower($package['specialization']); ?>-bg-img-<?php echo $ind; ?>">
            <div class="container">
                <div class="content-bg-layer">
                    <div id="therapy" class="therapy mt-5">
                        <hr>
                        </hr>
                        <div class="text">* <?php echo $package['treatmentName']; ?></div>
                        <hr>
                        </hr>
                        <p><?php echo $package['description']; ?></p>

                        <div class="mt-5">
                            <div class="col-md-12">
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