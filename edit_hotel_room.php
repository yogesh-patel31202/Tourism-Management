<?php
require_once(__DIR__ . '/src/service/HotelRoomService.php');
require_once(__DIR__ . '/src/service/HotelService.php');
require_once(__DIR__ . '/src/dto/HotelDto.php');
require_once(__DIR__ . '/src/dto/HotelRoomDto.php');
require_once(__DIR__ . '/src/dto/HotelRoomImgDto.php');
if (isset($_GET['id'])) {
  // Retrieve the value of 'id' and sanitize it
  $hotel_room_id = htmlspecialchars($_GET['id']);
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
                <h2>Edit Hotal Room</h2>
              </div>
            </div>
          </div>
          <?php
                  $hr_ser = new HotelRoomService();
                  $hotal_room_dto = $hr_ser->getHotelRoomInfoById($hotel_room_id); 
           ?>

          <div class="row d-flex justify-content-center">
            <!-- Start  contact -->
            <div class="col-md-6">
              <div class="form">
              <form action="src/Action/HotelRoomAction.php" method="post" enctype="multipart/form-data" role="form" class="form-control">
                  <div class="form-group">
                    <input type="text" class="form-control" id="hotel_name" value="<?php echo $hotal_room_dto->getHotelName(); ?>" list="hotel_list" oninput="getHotalId();" onblur="checkHotel();" placeholder="Hotel Name" required>
                    <input type="hidden" name="Id" id="id" value="<?php echo $hotal_room_dto->getId(); ?>">
                    <input type="hidden" name="Hotel_id_fk" id="hotel_id_fk" value="<?php echo $hotal_room_dto->getHotelIdFk(); ?>">
                    <input type="hidden" name="Remove_images_id" id="remove_images_id" value="">
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
                    <input type="text" name="Room_number" value="<?php echo $hotal_room_dto->getRoomNumber(); ?>" class="form-control" id="room_number" placeholder="Room Number" required>
                  </div>

                  <div class="form-group mt-3">
                    <input type="number" step="0.01" name="Capacity" value="<?php echo $hotal_room_dto->getCapacity(); ?>" class="form-control" id="capacity" placeholder="Capacity" required>
                  </div>

                  <div class="form-group mt-3">
                    <textarea class="form-control" name="Description" id="description" rows="3" placeholder="Description" required=""><?php echo $hotal_room_dto->getDescription(); ?></textarea>
                  </div>

                  <div class="form-group mt-3">
                    <input type="number" step="0.01" name="Price" value="<?php echo $hotal_room_dto->getPrice(); ?>" class="form-control" id="price" placeholder="Price" required>
                  </div>

                  <div class="form-group mt-3">
                    <div class="d-flex justify-content-center col-12">
                    <?php
                  $hotelRoomImgList = $hr_ser->getHotelRoomImgByRoomId($hotel_room_id);  // Corrected: use $service to call getUserInfo
                  foreach ($hotelRoomImgList as $hotel_room_img_dto) {?>

                      <div style="margin-left: 10px;" class="text-center col-4" id="image_div_<?php echo $hotel_room_img_dto->getId();?>">
                            <img src="hotel_room_img/hr_<?php echo $hotel_room_img_dto->getId();?>.jpg" onerror="this.src='assets/img/dummy.png'" class="preview"
                              alt="" style="height: 100px; width: 100px;">
                          <br>
                        <i class="bi bi-trash" onclick="hideImagesDiv('<?php echo $hotel_room_img_dto->getId();?>');"></i>
                        <a href="hotel_room_img/hr_<?php echo $hotel_room_img_dto->getId();?>.jpg" download style="margin-left: 20px;"><i class="bi bi-download" ></i></a>
                      </div>

                      <?php } ?>
                    </div>
                  </div>

                  <div class="form-group mt-3">
                  <label for="status">Choose Room Status:</label>
                  <select name="Status" id="status">
                    <option value="Active" <?php if($hotal_room_dto->getStatus()=="Active"){echo "selected";} ?>>Active</option>
                    <option value="Block" <?php if($hotal_room_dto->getStatus()=="Block"){echo "selected";} ?>>Block</option>
                  </select>
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

<script>
    function hideImagesDiv(image_id) {
        var image_div = document.getElementById('image_div_' + image_id);
        
        var confirmationMessage = 'Are you sure you want to remove this image?';

        var confirmed_status = window.confirm(confirmationMessage);
        if (confirmed_status) {
          addImageId(image_id);
          image_div.remove();
        }
    }

    var image_id_arr = [];
    function addImageId(image_id_value) {

        if (image_id_arr.includes(image_id_value)) {
          image_id_arr = image_id_arr.filter(num => num !== image_id_value);
        } else {
          image_id_arr.push(image_id_value);
        }

      document.getElementById('remove_images_id').value = image_id_arr.join(',');
}
</script>

</body>

</html>