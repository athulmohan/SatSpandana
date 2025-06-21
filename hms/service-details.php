<?php 
    $svcSql = "select * from doctorspecilization where LOWER(specilization) = '".strtolower($packageParam)."'";
    $services = mysqli_query($con, $svcSql);
    $i = 0;
    while($service=mysqli_fetch_assoc($services)) {
        $i++;
?>
    <?php if(isset($service['programs']) && $service['programs'] !== '') { ?>
        <section id="service-details" class="service-details">
            <div class="container-fluid">
                <div class="inner-title pt-0 mb-0">
                    <h3 class="font-weight-bold"><?php echo strtoupper($packageParam); ?></h3>
                    <!-- <div class="row">
                        <a href="javascript:void(0);" class="img-container col-lg-4 col-md-6">
                            <img src="../assets/images/features/physio.jpg" alt="Physiotherapy" class="image" style="width:100%">
                            <div class="middle">
                                <div class="text">Physiotherapy</div>
                            </div>
                        </a>
                    </div> -->
                </div>
                <div class="package-bg-img <?php //echo strtolower($service['specilization']); ?>-bg-img-<?php //echo $i; ?>">
                    <div class="">
                        <div class="content-bg-layer">
                            <div id="<?php echo strtolower($service['specilization']); ?>-service" class="container services py-5">
                                <p><?php echo $service['programs']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>