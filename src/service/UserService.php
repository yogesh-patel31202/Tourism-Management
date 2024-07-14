<?php

require_once(__DIR__ . '/../db/DataDb.php');
require_once(__DIR__ . '/../dto/UserDto.php');

class UserService {

    public function insertUser(UserDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("INSERT INTO users_tb (registration_date, PASSWORD, email, mobile, full_name) VALUES (?,?,?,?,?);");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            // Hash the password before storing it in the database
            //$hashedPassword = password_hash($dto->getPassword(), PASSWORD_DEFAULT);

            $registration_date = $dto->getRegistration_date();
            $password = $dto->getPassword();
            $email = $dto->getEmail();
            $mobile = $dto->getMobile();
            $full_name = $dto->getFull_name();

            $stmt->bind_param("sssss", $registration_date, $password, $email, $mobile, $full_name);

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


        public function getUserInfo() {

        $db = new DataDb();
    
        $list = array();
    
        try {
            $sql = "SELECT 	id, registration_date, PASSWORD, email, mobile, full_name FROM users_tb;";
            $result = $db->connection->query($sql);
    
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto = new UserDto();
    
                    $dto->setId($row['id']);
                    $dto->setRegistration_date($row['registration_date']);
                    $dto->setPassword($row['PASSWORD']);
                    $dto->setEmail($row['email']);
                    $dto->setMobile($row['mobile']);
                    $dto->setFull_name($row['full_name']);
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


    public function getUserInfoById($user_id) {
        $db = new DataDb();
    
        try {
            $sql = "SELECT id, registration_date, PASSWORD, email, mobile, full_name FROM users_tb WHERE id = ?";
    
            $stmt = $db->connection->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $dto = new UserDto();
            // Check if the query was successful
            if ($result) {
                // Fetch data from the result set
                while ($row = $result->fetch_assoc()) {
                    $dto->setId($row['id']);
                    $dto->setRegistration_date($row['registration_date']);
                    $dto->setPassword($row['PASSWORD']);
                    $dto->setEmail($row['email']);
                    $dto->setMobile($row['mobile']);
                    $dto->setFull_name($row['full_name']);
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


    public function updateUser(UserDto $dto) {

        $db = new DataDb();

        try {

            $stmt = $db->connection->prepare("UPDATE users_tb SET PASSWORD = ? , email = ? , mobile = ? , full_name = ? WHERE id = ? ;");

            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $db->connection->errno . ") " . $db->connection->error);
            }

            // Hash the password before storing it in the database
            //$hashedPassword = password_hash($dto->getPassword(), PASSWORD_DEFAULT);

            $password = $dto->getPassword();
            $email = $dto->getEmail();
            $mobile = $dto->getMobile();
            $full_name = $dto->getFull_name();
            $id = $dto->getId();

            $stmt->bind_param("ssssi", $password, $email, $mobile, $full_name, $id);

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
