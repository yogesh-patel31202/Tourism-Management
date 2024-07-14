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
                <h2>Sign Up</h2>
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">
            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form contact-form">
                <form action="src/Action/UserAction.php" method="post" role="form" class="form-control">
                  <div class="form-group">
                    <input type="text" name="Full_name" class="form-control" id="name" placeholder="Your Name" required>
                  </div>
                  <div class="form-group mt-3">
                    <input type="email" class="form-control" name="Email" id="email" placeholder="Your Email" required>
                  </div>

                  <div class="form-group mt-3">
                    <input type="number" class="form-control" name="Mobile" id="mobile" placeholder="Your Mobile" required>
                  </div>

                  <div class="form-group mt-3">
                    <input type="password" class="form-control" name="Password" id="password" placeholder="Password" required>
                  </div>
                  
                  <div class="text-center mt-3"><button type="submit">Submit</button></div>
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