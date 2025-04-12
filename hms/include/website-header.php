
    <?php 
        $logoSubPath = '';
        $linkSubPath = 'hms/';
        $a = str_contains($_SERVER['REQUEST_URI'], 'hms') ? true : false;
        if($a) {
            $logoSubPath = '../';
            $linkSubPath = '';
        }
    ?>
    <header id="menu-jk">
        <div id="nav-head" class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <a href="javascript:void(0);">
                            <img src="<?php echo $logoSubPath ?>assets/images/satspandana-logo-png.png" alt="SAT SPANDANA">
                            <!-- <img src="../assets/images/satspandana-logo-png.png" alt="SAT SPANDANA"> -->
                            <div class="col-lg-2 col-md-3 col-sm-12" style="color:#000;font-weight:bold; font-size:42px; margin-top: 1% !important; margin-bottom:1%;">
                                <!-- SATSPANDANA -->
                                <a data-toggle="collapse" data-target="#menu" href="#menu" ><i class="fas d-block d-md-none small-menu fa-bars"></i></a>
                            </div>
                        </a>
                    </div>
                    <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#about_us">About Us</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#contact_us">Contact Us</a></li>
                            <!-- <li><a href="#">Packages</a></li> -->
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Logins <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="hms/user-login.php">Patient Login</a></li>
                                    <li><a href="hms/doctor">Doctors Login</a></li>
                                    <li><a href="hms/admin">Admin Login</a></li>
                                </ul>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Logins
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item" href="<?php echo $linkSubPath; ?>user-login.php">Patient Login</a>
                                    <!-- <a class="dropdown-item" href="user-login.php">Patient Login</a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo $linkSubPath; ?>doctor">Doctors Login</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo $linkSubPath; ?>admin">Admin Login</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                    <a class="dropdown-item" href="<?php echo $linkSubPath; ?>our-teams.php">Our Team</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo $linkSubPath; ?>accommodation.php">Our Home Stay</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-2 appoint py-3">
                        <a class="btn btn-success" href="<?php echo $linkSubPath; ?>guest-book-appointment.php">Book an Appointment</a>
                    </div>
                </div>

            </div>
        </div>
    </header>