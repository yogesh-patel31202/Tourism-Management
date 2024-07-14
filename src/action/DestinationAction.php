<?php
require_once(__DIR__ . '/../service/DestinationService.php');
require_once(__DIR__ . '/../dto/DestinationDto.php');

class DestinationAction {
    
    public function doPost() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->processPostRequest();
        }
    }

    private function processPostRequest() {
        $dto = new DestinationDto();
        $ser = new DestinationService();

        $dto->setId(isset($_POST["Id"]) ? intval($_POST["Id"]) : 0);
        $dto->setName(isset($_POST["Name"]) ? $_POST["Name"] : "");
        $dto->setLocation(isset($_POST["Location"]) ? $_POST["Location"] : "");
        $dto->setDescription(isset($_POST["Description"]) ? $_POST["Description"] : "");
        $dto->setStatus(isset($_POST["Status"]) ? $_POST["Status"] : "");

        if (isset($_FILES["Image"])) {
            $uploadDir = "../../destination_img/";
            $max_id_value = $ser->getMaxId();
            echo $max_id_value;
            
            if($_FILES["Image"]["error"] == UPLOAD_ERR_OK && $_FILES["Image"]["size"] < 30000000){
            // Use a unique name for the uploaded file, incorporating the max ID
            //$uploadFile = $uploadDir.basename($_FILES["Image"]["name"], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . "des_" . $max_id_value . ".jpg";

            // Check if the file is an actual image
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");
           // imagecreatefromjpeg($inputFile);
            if (in_array($imageFileType, $allowedExtensions)) {
                // Move the uploaded file to the specified directory
                if($dto->getId()==0){
                    if (move_uploaded_file($_FILES["Image"]["tmp_name"], $uploadFile)) {
                        // Get other form data
                        // Your additional processing here
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        echo "Error uploading the file.\n";
                    }
                }
                if($dto->getId()>0){
                    $filePath = $uploadDir . "des_" . $dto->getId() . ".jpg";
                    // Check if the file exists before attempting to delete
                    if (file_exists($filePath)) {
                        // Attempt to delete the file
                        if (unlink($filePath)) {
                            echo "File deleted successfully.";
                        } else {
                            echo "Error deleting the file.";
                        }
                    } else {
                        echo "File does not exist.";
                    }
                    
                    //upload new file after deleting the file.
                    if (move_uploaded_file($_FILES["Image"]["tmp_name"], $filePath)) {
                        // Get other form data
                        // Your additional processing here
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        echo "Error uploading the file.\n";
                    }
                }
            } 
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.\n";
            }
        
        }else {
            echo "No file uploaded.\n";
        }

        // condition for insert
        if ($dto->getId() == 0) {
            $b = $ser->insertDestination($dto);

            if ($b) {
                header("Location: ../../add_destination.php?msg=Yes");
                exit();
            } else {
                header("Location: ../../add_destination.php?msg=No");
                exit();
            }
        } else {
            $b = $ser->updateDestination($dto);

            if ($b) {
                header("Location: ../../manage_destination.php?msg=Yes");
                exit();
            } else {
                header("Location: ../../manage_destination.php?msg=No");
                exit();
            }
        }
    }
}

$action = new DestinationAction();
$action->doPost();
?>
