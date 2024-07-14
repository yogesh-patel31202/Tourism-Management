<?php
require_once(__DIR__ . '/src/service/HotelService.php');
require_once(__DIR__ . '/src/dto/HotelDto.php');

if (isset($_GET['id'])) {
  // Retrieve the value of 'id' and sanitize it
  $hotel_id = htmlspecialchars($_GET['id']);
}

?>

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
                <h2>Update Hotel</h2>
              </div>
            </div>
          </div>

        <?php
        $service = new HotelService();
        $dto = $service->getHotelInfoById($hotel_id);
        ?>

          <div class="row d-flex justify-content-center">
            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form contact-form">
                <form action="src/Action/HotelAction.php" method="post" enctype="multipart/form-data" role="form" class="form-control">
                  <div class="form-group">
                    <input type="text" name="Name" value="<?php echo $dto->getName(); ?>" class="form-control" id="name" placeholder="Name" required>
                    <input type="hidden" name="Id" id="id" value="<?php echo $dto->getId(); ?>">
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" name="Location" value="<?php echo $dto->getLocation(); ?>" id="location" placeholder="Location" required>
                  </div>

                  <div class="form-group mt-3">
                    <textarea class="form-control" name="Description" id="description" rows="15" placeholder="Description" required=""><?php echo $dto->getDescription(); ?></textarea>
                  </div>

                  <div class="form-group mt-3">
                  <label for="status">Choose Hotel Status:</label>
                  <select name="Status" id="status">
                    <option value="Active" <?php if($dto->getStatus()=="Active"){echo "selected";} ?>>Active</option>
                    <option value="Block" <?php if($dto->getStatus()=="Block"){echo "selected";} ?>>Block</option>
                  </select>
                  </div>

                  <div class="form-group mt-3">
                  <label for="image">Choose an image:</label>
                  <input type="file" name="Image" id="image" accept="image/*" onchange="previewImage(event);">
                  </div>

                  <div class="d-flex justify-content-center">
											<img src="hotel_img/<?php echo "hotel_".$dto->getId().".jpg"; ?>" id="preview-selected-image" onerror="this.src='assets/img/dummy.png'"
												class="preview" alt="" style="width: 100px; height: 100px;">
									</div>

                  <div class="d-flex justify-content-center">
                    <a href="home_slider_img/<?php echo "hs_".$dto->getId().".jpg"; ?>" download="<?php echo $dto->getName().".jpg"; ?>"><i class="bi bi-download theme-color" style="font-size: 20px;" title="Download Image"></i></a>
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