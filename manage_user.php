<?php
require_once(__DIR__ . '/src/service/UserService.php');
require_once(__DIR__ . '/src/dto/UserDto.php');
require_once(__DIR__ . '/src/service/DateFormate.php');

?>

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
                <h2>User Report</h2>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">SN</th>
      <th class="th-sm">Name</th>
      <th class="th-sm">Mobile</th>
      <th class="th-sm">Email</th>
      <th class="th-sm">Registraion Date</th>
      <th class="th-sm">Password</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $service = new UserService();
        $dateService = new DateFormate();
        $userList = $service->getUserInfo();  // Corrected: use $service to call getUserInfo
        foreach ($userList as $index => $dto) 
        //$dateTime = new DateTime($dto->getRegistration_date());
    
        {?>

        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $dto->getFull_name(); ?></td>
            <td><?= $dto->getMobile(); ?></td>
            <td><?= $dto->getEmail(); ?></td>
            <td><?= $dateService->dateFormateYYYYMMDDtoDDMMYYYY($dto->getRegistration_date()) ?></td>
            <td><?= $dto->getPassword(); ?></td>
            <td><a href="edit_user.php?id=<?= $dto->getId(); ?>"><i class="bi bi-pencil"></i></a></td>
            <td><a href="src/invoke/DeleteInvoke.php?user_id=<?= $dto->getId(); ?>"><i class="bi bi-trash"></i></a></td>
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