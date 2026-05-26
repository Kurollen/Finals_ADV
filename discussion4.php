<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <p class="display-4">
       <div class="container  bg-dark p-5 w-50 text-white">
        <form action="discussion4.php" method="post">
            <div class="row">
                <!-- <div class="col">input:
                    <label for="" class="form-label">Date</label>
                    <input type="date" name="date" id="" class="form-control">
                </div> -->
            </div>
                 <div class="row mt-3">
                <div class="col text-center">
                    <input type="submit" name="sub" value="Save" class="btn btn-danger w-75">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="" class="form-label">Math</label>
                    <input type="number" name="num1" id="" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="" class="form-label">Science</label>
                    <input type="number" name="num2" id="" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="" class="form-label">Filipino</label>
                    <input type="number" name="num3" id="" class="form-control">
                </div>
            </div>
        </form>
    </div>
        
        <?php
            include "externalfunctions.php";
            //require

            $word = "Hello world";
            $noofchar=strlen($word);

            echo "---String Functions--- <br>";
            echo "Count the no. of characters: ",strlen($word).$noofchar;
            echo "<br> Count the no. of word/s: ", str_word_count($word);
            echo "<br>Reverse String: ", strrev($word);
            echo "<br> String Position: ",strpos($word, "World"); //var, word searched
            echo "<br>String Replace : ",str_replace("World", "admin", $word); //orig, new, source var
            echo "<br> Lowercase: ", strtolower($word);
            echo "<br> Uppercase: ", strtoupper($word);
            echo "<br>First - character caps: ",ucwords($word);
            echo "<br>First - letter caps: ",ucfirst($word);
            echo "<br>First - letter small: ",lcfirst($word);
            echo "<br>";

        $num = 3246090.980237;
        $arr1 = [56,78,34,90,7,12];
        $arr2 = array(45,23,12,34,89,90);
        $numf = number_format($num,5);

        echo "<br>---Number Functions---";
        echo "<br> NumF: ".$numf; //numbers become string if used in a function like number function
        echo "<br>Number Format: ",number_format($num,3);
        echo "<br>Rounded Format: ",round($num,2);
        echo "<br>Absolute: ",abs(-574890); //gets the absolute value
        echo "<br> Random Number: ",rand(1,100); //random
        echo "<br>Max Value: ",max($arr1); //max value
        echo "<br>Min Value: ",min($arr2); //min value

        echo "<br> <br> ---Date Functions---";
        echo "<br> Date: ",date('m-d-Y, D');
        echo "<br> Day ",date('z')." of the year ", date("Y");
        echo "<br> Day ",date('L')." of the year ", date("Y");

        //date_default_timezone_set("Asia/Manila");
        echo"<br> Current Date: ", date ('l, M j Y h:i:s A')."<br>";
        /*
         * d- (01 to 31)
         * D textual representaion of the day (three letters)
         * j (1-31, without leading 0)
         * l (full textual representation of the day
         * N (1 for monday, 2 for tuesday ...)   
         * S - ordinal suffic of the month
         * w (0 for sunday, 6 for saturday)
         * z - day of the year
         * W - week number of the year
         * F full textual representation of the month
         * m - numeric rep of the month
         * M three letters of the month
         * n numeric representation of a month without leading zeros
         * t - The number of days in the given month
         * L Whether it's a leap year (1 if leap year, 0 is not)
         * Y - four digit year
         * y- two digit
         * 
         * 
         * --- Time ---
         * a- lowercase am pm
         * A uppercase AM/PM
         * B swatch internet time (000 to 999)
         * g/h 12 hour format (1-12)
         * G/H 24 hour format (0-23)
         * i minutes with leading zeros (00 to 59)
         * s seconds with leading zeros
         * u Microseconds (PHP 5.2.2)
        */
        if (isset($_POST['sub'])) {
            $math = $_POST['num1'];
            $science = $_POST['num2'];
            $filipino = $_POST['num3'];

            echo "Total Average: ", ave($math,$science,$filipino);
        }


        // if(isset($_POST['sub']))
        //     {
        //         // $date = $_POST['date'];
        //         // $convertedDate = date_create($date);
        //         //shorter
        //         $date = date_create($_POST['date']);
        //         echo"<br> Formatted Date: ", date_format($date,'F d, Y');
        //     }
        $average = 0;

  
            echo ave(90,80,90);
            echo "Average: ",ave(78,90,85);

            $math = 90;
            $science = 85;
            $filipino = 75;

            echo ave($math,$science,$filipino);
            echo "<br>Remarks: ",remarks($average);


        ?>

    </p>
    
</body>
</html>