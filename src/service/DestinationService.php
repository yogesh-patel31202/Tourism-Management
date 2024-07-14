<?php

require_once(__DIR__ . '/../db/DataDb.php');
require_once(__DIR__ . '/../dto/DestinationDto.php');

class DestinationService {

    function getMaxId() {
        try {
            $db = new DataDb();
            $connection = $db->connection;
    
            $result = $connection->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name='destinations_tb' AND TABLE_SCHEMA='tourism_management';");
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

    public function insertDestination(DestinationDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("INSERT INTO destinations_tb (NAME, description, location)VALUES(?,?,?);");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            $name = $dto->getName();
            $description = $dto->getDescription();
            $location = $dto->getLocation();


            $stmt->bind_param("sss", $name, $description, $location);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {

            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            $db->connection->close();
        }

        return false;
    }


    public function getDestinationInfo() {

        $db = new DataDb();
    
        $list = array();
    
        try {
            $sql = "SELECT 	id, name, description, location, status FROM destinations_tb;";
            $result = $db->connection->query($sql);
    
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto = new DestinationDto();
                    $dto->setId($row['id']);
                    $dto->setName($row['name']);
                    $dto->setDescription($row['description']);
                    $dto->setLocation($row['location']);
                    $dto->setStatus($row['status']);
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


    public function getDestinationInfoById($destination_id) {
        $db = new DataDb();
    
        try {
            $sql = "SELECT 	id, name, description, location, status FROM destinations_tb WHERE id = ?";
    
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $destination_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $dto = new DestinationDto();
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto->setId($row['id']);
                    $dto->setName($row['name']);
                    $dto->setDescription($row['description']);
                    $dto->setLocation($row['location']);
                    $dto->setStatus($row['status']);
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


    public function updateDestination(DestinationDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("UPDATE destinations_tb SET NAME = ?, description = ?, location = ?, STATUS = ? WHERE id = ?;");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            $name = $dto->getName();
            $description = $dto->getDescription();
            $location = $dto->getLocation();
            $status = $dto->getStatus();
            $id = $dto->getId();

            $stmt->bind_param("ssssi", $name, $description, $location, $status, $id);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            $stmt->close();

            return true;

        } catch (Exception $e) {

            // Log the error or handle it appropriately
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the connection
            $db->connection->close();
        }

        return false;
    }
    
}


?>
