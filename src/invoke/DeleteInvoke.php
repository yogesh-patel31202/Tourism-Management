<?php
require_once(__DIR__ . '/../service/DeleteService.php');
require_once(__DIR__ . '/../dto/UserDto.php');

$del_ser = new DeleteService();

if (isset($_GET['user_id'])) {
  // Retrieve the value of 'id' and sanitize it
  $user_id = htmlspecialchars($_GET['user_id']);
  $b = $del_ser->deleteUser($user_id);

    if ($b) {
        header("Location: ../../manage_user.php?msg=Yes");
        exit();
    } else {
        header("Location: ../../manage_user.php?msg=No");
        exit();
    }
}

if (isset($_GET['destination_id'])) {
    // Retrieve the value of 'id' and sanitize it
    $destination_id = htmlspecialchars($_GET['destination_id']);
    $b = $del_ser->deleteDestination($destination_id);
  
      if ($b) {
          header("Location: ../../manage_destination.php?msg=Yes");
          exit();
      } else {
          header("Location: ../../manage_destination.php?msg=No");
          exit();
      }
  }

  if (isset($_GET['home_slider_id'])) {
    // Retrieve the value of 'id' and sanitize it
    $home_slider_id = htmlspecialchars($_GET['home_slider_id']);
    $b = $del_ser->deleteHomeSlider($home_slider_id);
  
      if ($b) {
          header("Location: ../../manage_home_slider.php?msg=Yes");
          exit();
      } else {
          header("Location: ../../manage_home_slider.php?msg=No");
          exit();
      }
  }

  if (isset($_GET['hotel_id'])) {
    // Retrieve the value of 'id' and sanitize it
    $hotel_id = htmlspecialchars($_GET['hotel_id']);
    $b = $del_ser->deleteHotel($hotel_id);
    $temp_bool = $del_ser->deleteHotelRoomByHotelId($hotel_id);
  
      if ($b) {
          header("Location: ../../manage_hotel.php?msg=Yes");
          exit();
      } else {
          header("Location: ../../manage_hotel.php?msg=No");
          exit();
      }
  }

  if (isset($_GET['hotel_room_id'])) {
    // Retrieve the value of 'id' and sanitize it
    $hotel_room_id = htmlspecialchars($_GET['hotel_room_id']);
    $b = $del_ser->deleteHotelRoom($hotel_room_id);
  
      if ($b) {
          header("Location: ../../manage_hotel.php?msg=Yes");
          exit();
      } else {
          header("Location: ../../manage_hotel.php?msg=No");
          exit();
      }
  }

?>
