<?php
require_once(__DIR__ . '/../service/UserService.php');
require_once(__DIR__ . '/../dto/UserDto.php');

class UserAction {
    
    public function doPost() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->processPostRequest();
        }
    }

    private function processPostRequest() {
        $dto = new UserDto();
        $ser = new UserService();

        $dto->setId(isset($_POST["Id"]) ? intval($_POST["Id"]) : 0);
        $currentDate = date("Y-m-d");
        $dto->setRegistration_date($currentDate);
        $dto->setPassword(isset($_POST["Password"]) ? $_POST["Password"] : "");
        $dto->setEmail(isset($_POST["Email"]) ? $_POST["Email"] : "");
        $dto->setMobile(isset($_POST["Mobile"]) ? $_POST["Mobile"] : "");
        $dto->setFull_name(isset($_POST["Full_name"]) ? $_POST["Full_name"] : "");

        // condition for insert
        if ($dto->getId() == 0) {
            $b = $ser->insertUser($dto);

            if ($b) {
                header("Location: ../../registration.php?msg=Yes");
                exit();
            } else {
                header("Location: ../../registration.php?msg=No");
                exit();
            }
        } else {
            $b = $ser->updateUser($dto);

            if ($b) {
                header("Location: ../../manage_user.php?msg=Yes");
                exit();
            } else {
                header("Location: ../../manage_user.php?msg=No");
                exit();
            }
        }
    }
}

$action = new UserAction();
$action->doPost();
?>
