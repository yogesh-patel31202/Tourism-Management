<?php

require_once(__DIR__ . '/../db/DataDb.php');
require_once(__DIR__ . '/../dto/HotelRoomDto.php');
require_once(__DIR__ . '/../dto/HotelRoomImgDto.php');

class HotelRoomService {

    function getMaxId() {
        try {
            $db = new DataDb();
            $connection = $db->connection;
    
            $result = $connection->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name='hotel_rooms_tb' AND TABLE_SCHEMA='tourism_management';");
            if ($row = $result->fetch_assoc()) {
                return $row['AUTO_INCREMENT'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage(); // Print or log the error message
        }
        return 0;
    }

    function getMaxIdHotelRoomImage() {
        try {
            $db = new DataDb();
            $connection = $db->connection;
    
            $result = $connection->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name='hotel_room_img_tb' AND TABLE_SCHEMA='tourism_management';");
            if ($row = $result->fetch_assoc()) {
                return $row['AUTO_INCREMENT'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage(); // Print or log the error message
        }
        return 0;
    }


    function getHotelRoomImgByRoomId($hotel_room_id) {
        $db = new DataDb();

        $list = array();

        try {
            $stmt = $db->connection->prepare("SELECT id FROM hotel_room_img_tb WHERE hotel_room_id_fk = ?;");
            $stmt->bind_param("i", $hotel_room_id);

            $stmt->execute();
            $resultSet = $stmt->get_result();

            while ($row = $resultSet->fetch_assoc()) {
                $dto = new HotelRoomImgDto();
                $dto->setId($row['id']);
                $list[] = $dto;
            }

        } catch (Exception $e) {
            // Handle the exception if needed
        } finally {
            if ($db->connection != null) {
                try {
                    $db->connection->close();
                } catch (Exception $e) {
                    // Handle the exception if needed
                }
            }
        }

        return $list;
    }



    function insertHotelRoomImage($hotel_room_id, $hotel_id) {
        $db = new DataDb();
    
        try {
            $stmt = $db->connection->prepare("INSERT INTO hotel_room_img_tb (hotel_room_id_fk, hotel_id_fk) VALUES (?,?)");
            $stmt->bind_param("ii", $hotel_room_id, $hotel_id);
    
            $stmt->execute();
    
            $affectedRows = $stmt->affected_rows;
    
            $stmt->close();
    
            return $affectedRows !== 0;
    
        } catch (Exception $e) {
            echo $e->getMessage(); // Print or log the error message
        }
    
        return false;
    }

    public function insertHotelRoom(HotelRoomDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("INSERT INTO hotel_rooms_tb (hotel_id_fk, room_number, capacity, description, price) VALUES (?,?,?,?,?);");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            $hotel_id_fk = $dto->getHotelIdFk();
            $room_number = $dto->getRoomNumber();
            $capaciry = $dto->getCapacity();
            $description = $dto->getDescription();
            $price = $dto->getPrice();

            $stmt->bind_param("isisi", $hotel_id_fk, $room_number, $capaciry, $description, $price);
            $stmt->execute();
            $lastInsertedId = $stmt->insert_id;
            
            $stmt->close();

            return $lastInsertedId;

        } catch (Exception $e) {

            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            $db->connection->close();
        }

        return 0;
    }

    public function getHotelRoomInfo() {

        $db = new DataDb();
    
        $list = array();
    
        try {
            $sql = "SELECT 	hrt.id, hotel_id_fk, room_number, capacity, hrt.description, price, hrt.status, ht.name
            FROM hotel_rooms_tb hrt INNER JOIN hotels_tb ht ON hrt.hotel_id_fk = ht.id;";
            $result = $db->connection->query($sql);
    
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto = new HotelRoomDto();
                    $dto->setId($row['hrt.id']);
                    $dto->setHotelIdFk($row['hotel_id_fk']);
                    $dto->setRoomNumber($row['room_number']);
                    $dto->setCapacity($row['capacity']);
                    $dto->setDescription($row['hrt.description']);
                    $dto->setPrice($row['price']);
                    $dto->setStatus($row['hrt.status']);
                    $dto->setHotel_name($row['ht.name']);
                    $list[] = $dto;
                }
    
                // Free the result set
                $result->free();
            } else {
                echo "Error: " . $sql . "<br>" . $db->connection->error;
            }
        } catch (Exception $e) {
            // Handle exceptions if needed
        } finally {
            // Close the connection
            $db->connection->close();
        }
    
        return $list;
    }

    public function getHotelRoomInfoByHotelId($hotel_id) {

        $db = new DataDb();
    
        $list = array();
    
        try {
            $sql = "SELECT 	hrt.id, hotel_id_fk, room_number, capacity, hrt.description, price, hrt.status, ht.name
            FROM hotel_rooms_tb hrt INNER JOIN hotels_tb ht ON hrt.hotel_id_fk = ht.id WHERE hotel_id_fk = ?;";

            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto = new HotelRoomDto();
                    $dto->setId($row['id']);
                    $dto->setHotelIdFk($row['hotel_id_fk']);
                    $dto->setRoomNumber($row['room_number']);
                    $dto->setCapacity($row['capacity']);
                    $dto->setDescription($row['description']);
                    $dto->setPrice($row['price']);
                    $dto->setStatus($row['status']);
                    $dto->setHotel_name($row['name']);
                    $list[] = $dto;
                }
    
                // Free the result set
                $result->free();
            } else {
                echo "Error: " . $sql . "<br>" . $db->connection->error;
            }
        } catch (Exception $e) {
            // Handle exceptions if needed
        } finally {
            // Close the connection
            $db->connection->close();
        }
    
        return $list;
    }

    public function getActiveHotelRoomInfo() {

        $db = new DataDb();
    
        $list = array();
    
        try {
            $sql = "SELECT 	hrt.id, hotel_id_fk, room_number, capacity, hrt.description, price, ht.name
            FROM hotel_rooms_tb hrt INNER JOIN hotels_tb ht ON hrt.hotel_id_fk = ht.id WHERE hrt.status='Active';";
            $result = $db->connection->query($sql);
    
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto = new HotelRoomDto();
                    $dto->setId($row['hrt.id']);
                    $dto->setHotelIdFk($row['hotel_id_fk']);
                    $dto->setRoomNumber($row['room_number']);
                    $dto->setCapacity($row['capacity']);
                    $dto->setDescription($row['hrt.description']);
                    $dto->setPrice($row['price']);
                    $dto->setHotel_name($row['ht.name']);
                    $list[] = $dto;
                }
    
                // Free the result set
                $result->free();
            } else {
                echo "Error: " . $sql . "<br>" . $db->connection->error;
            }
        } catch (Exception $e) {
            // Handle exceptions if needed
        } finally {
            // Close the connection
            $db->connection->close();
        }
    
        return $list;
    }

    public function getHotelRoomInfoById($hotel_room_id) {
        $db = new DataDb();
    
        try {
            $sql = "SELECT 	hrt.id, hotel_id_fk, room_number, capacity, hrt.description, price, hrt.status, ht.name
            FROM hotel_rooms_tb hrt INNER JOIN hotels_tb ht ON hrt.hotel_id_fk = ht.id WHERE hrt.id = ?;";
    
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $hotel_room_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $dto = new HotelRoomDto();
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto->setId($row['id']);
                    $dto->setHotelIdFk($row['hotel_id_fk']);
                    $dto->setRoomNumber($row['room_number']);
                    $dto->setCapacity($row['capacity']);
                    $dto->setDescription($row['description']);
                    $dto->setPrice($row['price']);
                    $dto->setStatus($row['status']);
                    $dto->setHotel_name($row['name']);
                }
    
                // Free the result set
                $result->free();
            } else {
                echo "Error: " . $sql . "<br>" . $db->connection->error;
            }
        } catch (Exception $e) {
            // Handle exceptions if needed
        } finally {
            // Close the statement
            $stmt->close();
    
            // Close the connection
            $db->connection->close();
        }
    
        return $dto;
    }


    public function updateHotelRoom(HotelRoomDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("UPDATE hotel_rooms_tb SET hotel_id_fk = ?, room_number = ?, capacity = ?, description = ?, price = ?, status = ? WHERE id = ? ;");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            $hotel_id_fk = $dto->getHotelIdFk();
            $room_number = $dto->getRoomNumber();
            $capacity = $dto->getCapacity();
            $description = $dto->getDescription();
            $price = $dto->getPrice();
            $status = $dto->getStatus();
            $id = $dto->getId();

            $stmt->bind_param("isisisi", $hotel_id_fk, $room_number, $capacity, $description, $price, $status, $id);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return $id;

        } catch (Exception $e) {

            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            $db->connection->close();
        }

        return 0;
    }
    
}


?>
