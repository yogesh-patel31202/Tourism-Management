<?php

class HotelRoomDto {
    private $id;
    private $hotel_id_fk;
    private $room_number;
    private $capacity;
    private $description;
    private $price;
    private $status;
    private $hotel_name;

    // Setter methods
    public function setId($id) {
        $this->id = $id;
    }

    public function setHotelIdFk($hotelIdFk) {
        $this->hotel_id_fk = $hotelIdFk;
    }

    public function setRoomNumber($roomNumber) {
        $this->room_number = $roomNumber;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setHotel_name($hotel_name) {
        $this->hotel_name = $hotel_name;
    }

    // Getter methods
    public function getId() {
        return $this->id;
    }

    public function getHotelIdFk() {
        return $this->hotel_id_fk;
    }

    public function getRoomNumber() {
        return $this->room_number;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getHotelName() {
        return $this->hotel_name;
    }
    
}
