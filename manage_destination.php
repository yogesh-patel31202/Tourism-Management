<?php
require_once(__DIR__ . '/src/service/DestinationService.php');
require_once(__DIR__ . '/src/dto/DestinationDto.php');

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
                <h2>Destination Report</h2>
              </div>
              <div class="mb-4">
              <a href="add_destination.php" class="add-btn"><i class="bi bi-patch-plus-fill"></i> Add Destination</a>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr class="text-center">
      <th width="5%">SN</th>
      <th width="8%">Title</th>
      <th width="12%">Name</th>
      <th width="20%">Location</th>
      <th width="35%">Description</th>
      <th width="5%">Status</th>
      <th width="3%">Edit</th>
      <th width="4%">Delete</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $service = new DestinationService();
        $destinationList = $service->getDestinationInfo();  // Corrected: use $service to call getUserInfo

        foreach ($destinationList as $index => $dto) {?>

        <tr class="text-center">
            <td><?= $index + 1 ?></td>
            <td>
              <div>
                <img style="width: 150px; height: 105px; border: 1px solid #3ec1d5;" src="destination_img/<?php echo "des_".$dto->getId().".jpg"; ?>">
              </div>
            </td>
            <td><?= $dto->getName(); ?></td>
            <td><?= $dto->getLocation(); ?></td>
            <td><?= $dto->getDescription(); ?></td>
            <td><?= $dto->getStatus(); ?></td>
            <td><a href="edit_destination.php?id=<?= $dto->getId(); ?>"><i class="bi bi-pencil theme-color"></i></a></td>
            <td><a href="src/invoke/DeleteInvoke.php?destination_id=<?= $dto->getId(); ?>"><i class="bi bi-trash theme-color"></i></a></td>
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