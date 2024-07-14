<!DOCTYPE html>
<html lang="en">

<head>
<?php
  include('include/head_admin.php'); 
  ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
  include('include/header_admin.php'); 
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
                <h2>Insert Hotal</h2>
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">
            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form">
                <form action="src/Action/HotelAction.php" method="post" enctype="multipart/form-data" role="form" class="form-control">
                  <div class="form-group">
                    <input type="text" name="Name" class="form-control" id="name" placeholder="Name" required>
                  </div>

                  <div class="form-group mt-3">
                    <textarea class="form-control" name="Location" id="location" rows="2" placeholder="Location" required=""></textarea>
                  </div>

                  <div class="form-group mt-3">
                    <textarea class="form-control" name="Description" id="description" rows="3" placeholder="Description" required=""></textarea>
                  </div>

                  <div class="form-group mt-3">
                  <label for="image">Choose an image:</label>
                  <input type="file" name="Image" id="image" accept="image/*" onchange="previewImage(event);">
                  </div>

                  <div class="d-flex justify-content-center">
											<img src="" id="preview-selected-image" onerror="this.src='assets/img/dummy.png'"
												class="preview" alt="" style="width: 100px; height: 100px;">
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
  include('include/footer_admin.php'); 
  ?>
  <!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- ======= js ======= -->
  <?php
  include('include/footer_js.php'); 
  ?>
  <!-- End  js -->

  <script type="text/javascript">
 
  function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function() {
      let element = document.getElementById('preview-selected-image');
      element.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  } 
  </script>


</body>

</html>