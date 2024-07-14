<?php
class HomeSliderDto {

    private $id;
    private $title;
    private $description;
    private $link;
    private $status;

    // Setter for $id
    public function setId($id) {
        $this->id = $id;
    }

    // Getter for $id
    public function getId() {
        return $this->id;
    }

    // Setter for $title
    public function setTitle($title) {
        $this->title = $title;
    }

    // Getter for $title
    public function getTitle() {
        return $this->title;
    }

    // Setter for $description
    public function setDescription($description) {
        $this->description = $description;
    }

    // Getter for $description
    public function getDescription() {
        return $this->description;
    }

    // Setter for $link
    public function setLink($link) {
        $this->link = $link;
    }

    // Getter for $link
    public function getLink() {
        return $this->link;
    }

    // Setter for $status
    public function setStatus($status) {
        $this->status = $status;
    }

    // Getter for $status
    public function getStatus() {
        return $this->status;
    }
}

?>