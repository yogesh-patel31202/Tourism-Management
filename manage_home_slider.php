<?php
require_once(__DIR__ . '/src/service/HomeSliderService.php');
require_once(__DIR__ . '/src/dto/HomeSliderDto.php');

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
                <h2>Home Slider Report</h2>
              </div>
              <div class="mb-4">
              <a href="add_home_slider.php" class="add-btn"><i class="bi bi-patch-plus-fill"></i> Add Home Slider</a>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr class="text-center">
      <th width="5%">SN</th>
      <th width="15%">Image</th>
      <th width="15%">Title</th>
      <th width="30%">Description</th>
      <th width="22%">Link</th>
      <th width="10%">Status</th>
      <th width="5%">Edit</th>
      <th width="5%">Delete</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $service = new HomeSliderService();
        $destinationList = $service->getHomeSliderInfo();  // Corrected: use $service to call getUserInfo

        foreach ($destinationList as $index => $dto) {?>

        <tr class="text-center">
            <td><?= $index + 1 ?></td>
            <td>
              <div>
                <img style="width: 150px; height: 105px; border: 1px solid #3ec1d5;" src="home_slider_img/<?php echo "hs_".$dto->getId().".jpg"; ?>">
              </div>
            </td>
            <td><?= $dto->getTitle(); ?></td>
            <td><?= $dto->getDescription(); ?></td>
            <td><?= $dto->getLink(); ?></td>
            <td><?= $dto->getStatus(); ?></td>
            <td><a href="edit_home_slider.php?id=<?= $dto->getId(); ?>"><i class="bi bi-pencil theme-color"></i></a></td>
            <td><a href="src/invoke/DeleteInvoke.php?home_slider_id=<?= $dto->getId(); ?>"><i class="bi bi-trash theme-color"></i></a></td>
        </tr>

          <?php }?>

  </tbody>
</table>
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

</body>

</html>