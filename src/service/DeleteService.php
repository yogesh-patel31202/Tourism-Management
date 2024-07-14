<?php

require_once(__DIR__ . '/../db/DataDb.php');

class DeleteService {

    public function deleteUser($user_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM users_tb WHERE id = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteDestination($destination_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM destinations_tb WHERE id = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $destination_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }


    public function deleteHomeSlider($home_slider_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM home_slider_tb WHERE id = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $home_slider_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteHotel($hotel_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM hotels_tb WHERE id = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            if($hotel_id>0){
                $uploadDir = "../../hotel_img/";
                $filePath = $uploadDir . "hotel_" . $hotel_id . ".jpg";
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
            }

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteHotelRoom($hotel_room_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM hotel_rooms_tb WHERE id = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_room_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            if($hotel_room_id>0){
                $uploadDir = "../../hotel_img/";
                $filePath = $uploadDir . "hr_" . $hotel_room_id . ".jpg";
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
            }

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteHotelRoomByHotelId($hotel_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM hotel_rooms_tb WHERE hotel_id_fk = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteHotelRoomImage($hotel_room_image_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM hotel_room_img_tb WHERE id = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_room_image_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteHotelRoomImageByRoomId($hotel_room_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM hotel_room_img_tb WHERE hotel_room_id_fk = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_room_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

    public function deleteHotelRoomImageByHotelId($hotel_id) {
        $db = new DataDb();

        try {
            $sql = 'DELETE FROM hotel_room_img_tb WHERE hotel_id_fk = ? ;';
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_id);
            $stmt->execute();

            // Check for execute errors
            if ($stmt->error) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            if (isset($db->connection)) {
                $db->connection->close();
            }
        }
        return false;
    }

}

?>
