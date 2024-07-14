<?php

class UserDto {
    private $id;
    private $registration_date, $password, $email, $mobile, $full_name;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getRegistration_date() {
        return $this->registration_date;
    }

    public function setRegistration_date($registration_date) {
        $this->registration_date = $registration_date;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    public function getFull_name() {
        return $this->full_name;
    }

    public function setFull_name($full_name) {
        $this->full_name = $full_name;
    }
}

?>
