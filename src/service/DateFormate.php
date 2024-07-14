<?php

class DateFormate {

    public function dateFormateYYYYMMDDtoDDMMYYYY($yyyy_mm_dd) {
        $dateTime = new DateTime($yyyy_mm_dd);
        // Format the date to "dd-mm-yyyy" format
        $formattedDate = $dateTime->format("d-m-Y");
        return $formattedDate;
    }

    public function dateFormateDDMMYYYYtoYYYYMMDD($dd_mm_yyyy) {
        $dateTime = new DateTime($dd_mm_yyyy);
        // Format the date to "dd-mm-yyyy" format
        $formattedDate = $dateTime->format("Y-m-d");
        return $formattedDate;
    }

}