<?php
require_once(__DIR__ . '/src/service/HotelRoomService.php');
require_once(__DIR__ . '/src/dto/HotelRoomDto.php');
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
                <h2>Hotal Room Report</h2>
              </div>
              <div class="mb-4">
              <a href="add_hotel_room.php?hotel_id=<?= $hotel_id; ?>" class="add-btn"><i class="bi bi-patch-plus-fill"></i> Add Hotel Room</a>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr class="text-center">
      <th width="5%">SN</th>
      <th width="15%">Hotal</th>
      <th width="20%">Room Number</th>
      <th width="10%">Capacity</th>
      <th width="35%">Description</th>
      <th width="15%">Price</th>
      <th width="5%">Status</th>
      <th width="3%">Edit</th>
      <th width="4%">Delete</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $service = new HotelRoomService();
        $hotalRoomList = $service->getHotelRoomInfoByHotelId($hotel_id);  // Corrected: use $service to call getUserInfo

        foreach ($hotalRoomList as $index => $dto) {?>

        <tr class="text-center">
            <td><?= $index + 1 ?></td>
            <td><?= $dto->getHotelName(); ?></td>
            <td><?= $dto->getRoomNumber(); ?></td>
            <td><?= $dto->getCapacity(); ?></td>
            <td><?= $dto->getDescription(); ?></td>
            <td><?= $dto->getPrice(); ?></td>
            <td><?= $dto->getStatus(); ?></td>
            <td><a href="edit_hotel_room.php?id=<?= $dto->getId(); ?>"><i class="bi bi-pencil theme-color"></i></a></td>
            <td><a href="src/invoke/DeleteInvoke.php?hotel_room_id=<?= $dto->getId(); ?>"><i class="bi bi-trash theme-color"></i></a></td>
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