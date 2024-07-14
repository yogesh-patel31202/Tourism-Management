<?php
require_once(__DIR__ . '/src/service/HotelService.php');
require_once(__DIR__ . '/src/dto/HotelDto.php');
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
                <h2>Insert Hotal Room</h2>
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">
            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form">
                <form action="src/Action/HotelRoomAction.php" method="post" enctype="multipart/form-data" role="form" class="form-control">
                  <div class="form-group">
                    <input type="text" class="form-control" id="hotel_name" list="hotel_list" oninput="getHotalId();" onblur="checkHotel();" placeholder="Hotel Name" required>
                    <input type="hidden" name="Hotel_id_fk" id="hotel_id_fk" value="0">
                  </div>

                  <datalist id="hotel_list">
                  <?php
                  $service = new HotelService();
                  $hotalList = $service->getActiveHotelInfo();  // Corrected: use $service to call getUserInfo

                  foreach ($hotalList as $index => $hotal_dto) {?>
                  <option data-id="<?=$hotal_dto->getId();?>" value="<?=$hotal_dto->getName()?>"><?=$hotal_dto->getName()?></option>
                  <?php } ?>
                  </datalist>

                  <div class="form-group mt-3">
                    <input type="text" name="Room_number" class="form-control" id="room_number" placeholder="Room Number" required>
                  </div>

                  <div class="form-group mt-3">
                    <input type="number" step="0.01" name="Capacity" class="form-control" id="capacity" placeholder="Capacity" required>
                  </div>

                  <div class="form-group mt-3">
                    <textarea class="form-control" name="Description" id="description" rows="3" placeholder="Description" required=""></textarea>
                  </div>

                  <div class="form-group mt-3">
                    <input type="number" step="0.01" name="Price" class="form-control" id="price" placeholder="Price" required>
                  </div>

                  <div class="form-group mt-3">
                  <label for="image">Choose an image:</label>
                  <input type="file" name="Images[]" multiple id="image" accept="image/*" onchange="previewImage(event);">
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

  <script>
    function getHotalId() {
        var inputElement = document.getElementById("hotel_name");
        var selectedOption = document.querySelector('#hotel_list option[value="' + inputElement.value + '"]');
        
        if (selectedOption) {
            var id = selectedOption.getAttribute('data-id');
            document.getElementById("hotel_id_fk").value = id;
        } else {
        	document.getElementById("hotel_id_fk").value = 0;
        }
    }

    function checkHotel(){
      var hotel_id_fk = document.getElementById("hotel_id_fk").value;
      if(hotel_id_fk==0){
        document.getElementById('hotel_name').value="";
        alert("Please insert the correct hotel name.");
      }
    }
</script>


</body>

</html>