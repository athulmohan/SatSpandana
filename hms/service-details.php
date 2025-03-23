<?php 
    $svcSql = "select * from doctorSpecilization where LOWER(specilization) = '".strtolower($packageParam)."'";
    $services = mysqli_query($con, $svcSql);
    $i = 0;
    while($service=mysqli_fetch_assoc($services)) {
        $i++;
?>
    <?php if(isset($service['programs']) && $service['programs'] !== '') { ?>
        <section id="service-details" class="service-details mt-5">
            <div class="container-fluid">
                <div class="inner-title pt-0 mb-0">
                    <h3><?php echo strtoupper($packageParam); ?></h3>
                </div>
                <div class="package-bg-img <?php echo strtolower($service['specilization']); ?>-bg-img-<?php echo $i; ?>">
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