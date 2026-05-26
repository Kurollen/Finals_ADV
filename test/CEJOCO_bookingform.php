<?php require 'CEJOCO_arr.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Form</title>
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
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }

        .container {
            display: flex;
            gap: 24px;
            max-width: 1100px;
            margin: 0 auto;
            align-items: flex-start;
        }

        /* ── LEFT: Booking Form ── */
        .booking-form {
            background: #fff;
            border-radius: 10px;
            padding: 28px 24px;
            flex: 1;
            box-shadow: 0 2px 12px rgba(0,0,0,0.09);
        }

        .booking-form h3 {
            text-align: center;
            background-color: #2c3e7a;
            color: #fff;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 1.1rem;
            letter-spacing: 0.4px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            color: #555;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #ccd0d8;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #333;
            background: #fafbfc;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2c3e7a;
            background: #fff;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 72px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #2c3e7a;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            letter-spacing: 0.5px;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #1a2d64;
        }

        /* ── RIGHT: Tour Details ── */
        .tour-details {
            background-color: #2c3e7a;
            border-radius: 10px;
            padding: 22px 20px;
            flex: 1;
            box-shadow: 0 2px 12px rgba(0,0,0,0.13);
        }

        .tour-details h3 {
            color: #fff;
            text-align: center;
            font-size: 1.05rem;
            margin-bottom: 16px;
            letter-spacing: 0.4px;
        }

        .tour-card {
            background: #fff;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 14px;
        }

        .tour-card:last-child {
            margin-bottom: 0;
        }

        .tour-card h4 {
            color: #2c3e7a;
            font-size: 0.97rem;
            margin-bottom: 6px;
        }

        .tour-card p {
            font-size: 0.80rem;
            color: #555;
            margin-bottom: 3px;
            line-height: 1.5;
        }

        .tour-card p span {
            font-weight: 700;
            color: #333;
        }
    </style>
</head>
<body>

<h2>Tour Booking System</h2>

<div class="container">

    <!-- LEFT: Booking Form -->
    <div class="booking-form">
        <h3>Booking Info</h3>
        <form action="CEJOCO_bookingdetails.php" method="POST">

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" placeholder="Enter contact number" required>
            </div>

            <div class="form-group">
                <label for="tourdate">Tour Date</label>
                <input type="date" id="tourdate" name="tourdate" required>
            </div>

            <div class="form-group">
                <label for="participants">Number of Participants</label>
                <input type="number" id="participants" name="participants" min="1" placeholder="Enter number of participants" required>
            </div>

            <div class="form-group">
                <label for="tour">Select Tour</label>
                <select id="tour" name="tour_index" required>
                    <option value="" disabled selected>-- Select a Tour --</option>
                    <?php foreach ($CEJOCOtourNames as $CEJOCOindex => $CEJOCOname): ?>
                        <option value="<?= $CEJOCOindex ?>">
                            <?= $CEJOCOname ?> &mdash; &#8369;<?= number_format($CEJOCOprices[$CEJOCOindex], 2) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="accommodations">Special Accommodations</label>
                <textarea id="accommodations" name="accommodations" placeholder="Any special requests or accommodations?"></textarea>
            </div>

            <button type="submit" class="btn-submit">Book Now</button>
        </form>
    </div>

    <!-- RIGHT: Tour Details Table -->
    <div class="tour-details">
        <h3>Tour Details</h3>
        <?php foreach ($CEJOCOtourNames as $CEJOCOindex => $CEJOCOname): ?>
            <div class="tour-card">
                <h4><?= $CEJOCOname ?></h4>
                <p><span>Duration:</span> <?= $CEJOCOduration[$CEJOCOindex] ?></p>
                <p><span>Description:</span> <?= $CEJOCOdescription[$CEJOCOindex] ?></p>
                <p><span>Price:</span> &#8369;<?= number_format($CEJOCOprices[$CEJOCOindex], 2) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</div><!-- end .container -->

</body>
</html>
