<?php 
    $svcSql = "select * from doctorSpecilization where LOWER(specilization) = '".strtolower($packageParam)."'";
    $services = mysqli_query($con, $svcSql);

    while($service=mysqli_fetch_assoc($services)) {
        // echo "<pre>"; print_r($service);die;
?>
    <?php if(isset($service['programs']) && $service['programs'] !== '') { ?>
        <section id="service-details" class="service-details mt-5">
            <div class="container-fluid">
                <div class="inner-title pt-0 mb-0">
                    <h3><?php echo strtoupper($packageParam); ?></h3>
                </div>
            
                <div class="<?php echo strtolower($service['specilization']); ?>-bg-img">
                    <div class="container">
                        <div class="row content-bg-layer">
                            <div id="<?php echo strtolower($service['specilization']); ?>-service" class="services mt-5">
                                <p><?php echo $service['programs']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>