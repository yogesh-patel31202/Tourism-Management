<?php

require_once(__DIR__ . '/../db/DataDb.php');
require_once(__DIR__ . '/../dto/HomeSliderDto.php');

class HomeSliderService {

    function getMaxId() {
        try {
            $db = new DataDb();
            $connection = $db->connection;
    
            $result = $connection->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name='home_slider_tb' AND TABLE_SCHEMA='tourism_management';");
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
    
    


    public function insertHomeSlider(HomeSliderDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("INSERT INTO home_slider_tb (title, description, link) VALUES (?,?,?);");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            $title = $dto->getTitle();
            $description = $dto->getDescription();
            $link = $dto->getLink();

            $stmt->bind_param("sss", $title, $description, $link);

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


    public function getHomeSliderInfo() {

        $db = new DataDb();
    
        $list = array();
    
        try {
            $sql = "SELECT 	id, title, description, link, status FROM home_slider_tb;";
            $result = $db->connection->query($sql);
    
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto = new HomeSliderDto();
                    $dto->setId($row['id']);
                    $dto->setTitle($row['title']);
                    $dto->setDescription($row['description']);
                    $dto->setLInk($row['link']);
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


    public function getHomeSliderInfoById($home_slider_id) {
        $db = new DataDb();
    
        try {
            $sql = "SELECT 	id, title, description, link, status FROM home_slider_tb WHERE id = ?";
    
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $home_slider_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $dto = new HomeSliderDto();
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto->setId($row['id']);
                    $dto->setTitle($row['title']);
                    $dto->setDescription($row['description']);
                    $dto->setLink($row['link']);
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


    public function updateHomeSlider(HomeSliderDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("UPDATE home_slider_tb SET title = ?, description = ?, link = ?, status = ? WHERE id = ?;");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            $title = $dto->getTitle();
            $description = $dto->getDescription();
            $link = $dto->getLink();
            $status = $dto->getStatus();
            $id = $dto->getId();

            $stmt->bind_param("ssssi", $title, $description, $link, $status, $id);

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
