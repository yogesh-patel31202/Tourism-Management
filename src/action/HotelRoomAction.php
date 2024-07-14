<?php
require_once(__DIR__ . '/../service/HotelRoomService.php');
require_once(__DIR__ . '/../dto/HotelRoomDto.php');
require_once(__DIR__ . '/../service/DeleteService.php');

class HotelRoomAction {
    
    public function doPost() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->processPostRequest();
        }
    }

    private function processPostRequest() {
        $dto = new HotelRoomDto();
        $ser = new HotelRoomService();
        $del_ser = new DeleteService();

        $dto->setId(isset($_POST["Id"]) ? intval($_POST["Id"]) : 0);
        $dto->setHotelIdFk(isset($_POST["Hotel_id_fk"]) ? intval($_POST["Hotel_id_fk"]) : 0);
        $dto->setRoomNumber(isset($_POST["Room_number"]) ? $_POST["Room_number"] : "");
        $dto->setCapacity(isset($_POST["Capacity"]) ? $_POST["Capacity"] : "");
        $dto->setDescription(isset($_POST["Description"]) ? $_POST["Description"] : "");
        $dto->setStatus(isset($_POST["Status"]) ? $_POST["Status"] : "");
        $dto->setPrice(isset($_POST["Price"]) ? $_POST["Price"] : "");
        $remove_images_id = (isset($_POST["Remove_images_id"]) ? $_POST["Remove_images_id"] : "");
        
        if ($dto->getId() == 0) {
            $hotel_room_id = $ser->insertHotelRoom($dto);
        } else {
            $hotel_room_id = $ser->updateHotelRoom($dto);
        }

        $uploadDir = "../../hotel_room_img/";
        if (!empty($remove_images_id)) {
            $remove_images_arr = explode(",", $remove_images_id);
            echo "length=" . count($remove_images_arr);
        
            foreach ($remove_images_arr as $image_id) {
                $img_status = $del_ser->deleteHotelRoomImage($image_id);
                echo "Image Delete or Not = " . $img_status;
        
                try {
                    unlink($uploadDir . "hr_" . $image_id . ".jpg");
        
                    echo $uploadDir . "hr_" . $image_id . ".jpg";
        
                } catch (Exception $e2) {
                    echo "Error deleting file: " . $e2->getMessage();
                }
            }
        }

        if (isset($_FILES["Images"])) {

            foreach ($_FILES['Images']['tmp_name'] as $key =>  $tmp_name) {
            
            if($_FILES["Images"]["error"][$key] == UPLOAD_ERR_OK && $_FILES["Image"]["size"][$key] < 30000000){
            // Use a unique name for the uploaded file, incorporating the max ID
            //$uploadFile = $uploadDir.basename($_FILES["Images"]["name"][$key], PATHINFO_EXTENSION);
            $max_id_value = $ser->getMaxIdHotelRoomImage();

            $uploadFile = $uploadDir . "hr_" . $max_id_value . ".jpg";

            // Check if the file is an actual image
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
           // imagecreatefromjpeg($inputFile);

            if (in_array($imageFileType, $allowedExtensions)) {
                // Move the uploaded file to the specified directory

                if (move_uploaded_file($_FILES["Images"]["tmp_name"][$key], $uploadFile)) {
                    $ser->insertHotelRoomImage($hotel_room_id, $dto->getHotelIdFk());
                    // Get other form data
                    // Your additional processing here
                    echo "File is valid, and was successfully uploaded.\n";
                } else {
                    echo "Error uploading the file.\n";
                }
                
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.\n";
            }
        }
        }
        } else {
            echo "No file uploaded.\n";
        }

        // condition for insert
        if ($dto->getId() == 0) {
            if ($hotel_room_id>0) {
                header("Location: ../../add_hotel_room.php?msg=Yes");
                exit();
            } else {
                header("Location: ../../add_hotel_room.php?msg=No");
                exit();
            }
        } else {
            if ($hotel_room_id>0) {
                header("Location: ../../manage_hotel_room.php?id=".$dto->getHotelIdFk());
                exit();
            } else {
                header("Location: ../../manage_hotel_room.php?id=".$dto->getHotelIdFk());
                exit();
            }
        }
    }
}

$action = new HotelRoomAction();
$action->doPost();
?>

