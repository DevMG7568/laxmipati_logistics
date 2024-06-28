<?php
    include "asp/config.php";

    //fetch settings
    $settings = mysqli_query($conn,"SELECT * FROM settings");
    $setting  = mysqli_fetch_array($settings);
?>

    <!-- Newsletter -->
    <section class="newsletter-section style-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-5">
                    <h3><span class="flaticon-email"></span> Subscribe Our Newsletter <br> & Get Updates.</h3>
                </div>
                <div class="col-lg-7">
                    <div class="newsletter-form">
                        <form action="subscribe.php" method="post">
                            <div class="form-group">
                                <i class="far fa-envelope-open"></i>
                                <input type="email" placeholder="Enter Your Email Address..."  name="email">
                                <button type="submit" class="theme-btn btn-style-one"><span><i class="flaticon-up-arrow" name="submit"></i>Subscribe</span></button>
                                <label class="subscription-label" for="subscription-email"></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </section>
<!--Main Footer-->
    <footer class="main-footer">
        <div class="upper-box">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="widget contact-widget style-two">
                            <h4>Do You Have Any Question? Please <br> Contact Our Team</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="wrapper-box">
                                        <div class="icon-box">
                                            <div class="icon"><span class="flaticon-calling"></span></div>
                                            <div class="text"><strong>Phone</strong><a href="tel:<?php echo $setting['phone']; ?>"><?php echo $setting['phone']; ?></a></div>
                                        </div>
                                        <div class="icon-box">
                                            <div class="icon"><span class="flaticon-mail"></span></div>
                                            <div class="text"><strong>Email</strong><a href="mail:<?php echo $setting['email']; ?>"><?php echo $setting['email']; ?></a></div>
                                        </div>
                                        <ul class="social-icon">
                                            <li><a href="https://www.facebook.com/people/Laxmipati-international/100095145333402/?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/laxmipati_international/?igshid=MzRlODBiNWFlZA%3D%3D"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="https://www.linkedin.com/in/laxmipati-courier-362938287/"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon-box">
                                        <div class="icon"><span class="flaticon-mail"></span></div>
                                        <div>
                                            <div class="text"><strong>Mon - Sunday</strong>08.00 am to 9.00pm</div>
                                           <!--- <div class="text"><strong>Saturday</strong>10.00 am to 4.00pm</div>
                                            <div class="text"><span>Sunday-Closed</span></div> --->
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget links-widget">
                                    <h4 class="widget_title">Useful Links</h4>
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li><a href="about.php">About Company</a></li>
                                            <li><a href="contact.php">Get In Touch</a></li>
                                            <li><a href="service.php">Our Services</a></li>
                                            <li><a href="track.php">Tracking</a></li>
                                            <li><a href="https://g.page/r/CRKo2jE_3MrjEBM/review" target="_blank">Google Review</a></li>
                                            <!---<li><a href="privacy.php">Privacy Policies</a></li>
                                            <li><a href="terms.php">Terms & Conditions</a></li> --->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="widget instagram-widget">
                                  <h4 class="widget_title">Google Review</h4>
                                <a href="#"> <img src="assets/images/qrcode.png" class="qr"> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>               
    </footer>
    <!--End Main Footer-->

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="row m-0 align-items-center justify-content-between">
                <div class="copyright-text">Copyright © 2023 <?php echo $setting['site_name']; ?> | Designed By <a target="blank" href="">WEBSY INFOTECH</a></div>
                <ul class="menu">
                    <li><a href="privacy.php">Privacy Policies</a></li>
                    <li><a href="terms.php">Terms & Conditions </a></li>
                    <li><a href="contact.php">  Contact Us</a></li>
                </ul>
            </div>            
        </div>
    </div>
	
</div>
<!--End pagewrapper-->