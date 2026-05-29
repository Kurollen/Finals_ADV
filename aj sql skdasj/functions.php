<?php

function formatText($text) {
    return ucwords(strtolower($text));
}

function getRoomType($type) {
    switch ($variable) {
        case 'Standard':
            return "Standard";
            break;

        case 'Deluxe':
            return "Deluxe";
            break;

        case 'Suite':
            return "Suite";
            break;
    }
}

function getRoomPrice($room) {
    switch ($room) {
        case 'Standard':
            return 1500.00;
            break;

        case 'Deluxe':
            return 3000.00;
            break;

        case 'Suite':
            return 4500.00;
            break;

    }
}

function getTotalGuests($adult, $child, $add) {
    return $adult + $child + $add;
}

function getTotalRoomPrice($price, $days) {
    return $price * $days;
}

function getAdditionalFee($addGuests) {
    $feePerGuest = 500;
    return $addGuests * $feePerGuest;
}

function getTotalAmount($roomTotal, $addFee) {
    return $roomTotal + $addFee;
}

?>