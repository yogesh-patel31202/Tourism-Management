<!DOCTYPE html>
<html lang="en">

<head>
<?php
  include('include/head.php'); 
  ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
  include('include/header.php'); 
  ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row mt-4">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Login</h2>
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">
            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form contact-form">
                <form action="forms/user_registration.php" method="post" role="form" class="php-email-form">
                  <div class="form-group mt-3">
                    
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  </div>

                  <div class="form-group mt-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                  </div>

                  <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit">Submit</button></div>
                </form>
              </div>
            </div>
            <!-- End Left contact -->
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include('include/footer.php'); 
  ?>
  <!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- ======= js ======= -->
  <?php
  include('include/footer_js.php'); 
  ?>
  <!-- End  js -->

</body>

</html>