<?php
require 'CEJOCO_arr.php';

// Retrieve POST data
$CEJOCOfullname       = htmlspecialchars($_POST['fullname'] ?? '');
$CEJOCOaddress        = htmlspecialchars($_POST['address'] ?? '');
$CEJOCOemail          = htmlspecialchars($_POST['email'] ?? '');
$CEJOCOcontact        = htmlspecialchars($_POST['contact'] ?? '');
$CEJOCOtourdate       = htmlspecialchars($_POST['tourdate'] ?? '');
$CEJOCOparticipants   = intval($_POST['participants'] ?? 0);
$CEJOCOtourIndex      = intval($_POST['tour_index'] ?? 0);
$CEJOCOaccommodations = htmlspecialchars($_POST['accommodations'] ?? '');

// Format tour date to display day of week
$CEJOCOformattedDate = '';
if (!empty($CEJOCOtourdate)) {
    $CEJOCOdateObj = new DateTime($CEJOCOtourdate);
    $CEJOCOformattedDate = $CEJOCOdateObj->format('F d, Y') . ' &mdash; ' . $CEJOCOdateObj->format('l');
}

// Price calculation
$CEJOCObasePrice    = $CEJOCOprices[$CEJOCOtourIndex];
$CEJOCOextraFee     = 0;
$CEJOCOextraPersons = 0;

if ($CEJOCOparticipants > 10) {
    $CEJOCOextraPersons = $CEJOCOparticipants - 10;
    $CEJOCOextraFee     = $CEJOCOextraPersons * 50;
}

$CEJOCOtotalPrice = $CEJOCObasePrice + $CEJOCOextraFee;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            padding: 30px 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #1a1a2e;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .container {
            max-width: 820px;
            margin: 0 auto;
            background-color: #2c3e7a;
            border-radius: 12px;
            padding: 24px 22px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.15);
        }

        .container h3 {
            text-align: center;
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        .cards-row {
            display: flex;
            gap: 18px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 20px 18px;
            flex: 1;
        }

        .card h4 {
            color: #2c3e7a;
            font-size: 0.95rem;
            border-bottom: 2px solid #2c3e7a;
            padding-bottom: 7px;
            margin-bottom: 14px;
            letter-spacing: 0.3px;
        }

        .card p {
            font-size: 0.83rem;
            color: #444;
            margin-bottom: 8px;
            line-height: 1.55;
        }

        .card p span.label {
            font-weight: 700;
            color: #222;
        }

        .total-price {
            text-align: right;
            color: #2c3e7a;
            font-size: 1rem;
            font-weight: 800;
            margin-top: 14px;
            padding-top: 10px;
            border-top: 2px solid #d0d8f0;
        }

        .extra-fee-note {
            font-size: 0.78rem;
            color: #c0392b;
            font-weight: 600;
        }

        .btn-back {
            display: block;
            width: fit-content;
            margin: 22px auto 0;
            padding: 10px 28px;
            background-color: #2c3e7a;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s;
        }

        .btn-back:hover {
            background-color: #1a2d64;
        }
    </style>
</head>
<body>

<h2>Booking Confirmation</h2>

<div class="container">
    <h3>Booking Confirmation</h3>

    <div class="cards-row">

        <!-- Basic Information -->
        <div class="card">
            <h4>Basic Information</h4>
            <p><span class="label">Full Name:</span> <?= $CEJOCOfullname ?></p>
            <p><span class="label">Address:</span> <?= $CEJOCOaddress ?></p>
            <p><span class="label">Contact Number:</span> <?= $CEJOCOcontact ?></p>
            <p><span class="label">Email:</span> <?= $CEJOCOemail ?></p>
        </div>

        <!-- Tour Details -->
        <div class="card">
            <h4>Tour Details</h4>
            <p><span class="label">Tour:</span> <?= $CEJOCOtourNames[$CEJOCOtourIndex] ?></p>
            <p><span class="label">Duration:</span> <?= $CEJOCOduration[$CEJOCOtourIndex] ?></p>
            <p><span class="label">Description:</span> <?= $CEJOCOdescription[$CEJOCOtourIndex] ?></p>
            <p><span class="label">Date:</span> <?= $CEJOCOformattedDate ?></p>
            <p><span class="label">Number of Participants:</span> <?= $CEJOCOparticipants ?></p>
            <p><span class="label">Special Accommodations:</span> <?= !empty($CEJOCOaccommodations) ? $CEJOCOaccommodations : 'None' ?></p>
            <p><span class="label">Price:</span> PHP <?= number_format($CEJOCObasePrice, 2) ?></p>

            <?php if ($CEJOCOextraFee > 0): ?>
                <p class="extra-fee-note">
                    Extra Fee (&#8369;50 per additional participant):
                    PHP <?= number_format($CEJOCOextraFee, 2) ?>
                    <br><small>(<?= $CEJOCOextraPersons ?> extra participant<?= $CEJOCOextraPersons > 1 ? 's' : '' ?> beyond 10)</small>
                </p>
            <?php endif; ?>

            <div class="total-price">
                Total Price: PHP <?= number_format($CEJOCOtotalPrice, 2) ?>
            </div>
        </div>

    </div><!-- end .cards-row -->
</div><!-- end .container -->

<a href="CEJOCO_bookingform.php" class="btn-back">&larr; Back to Booking Form</a>

</body>
</html>
