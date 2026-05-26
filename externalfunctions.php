<?php
          function ave($num1, $num2, $num3)
            {
                $ave = ($num1 + $num2 +$num3)/3;
                return $ave;
            }

            function remarks($ave)
            {
                if ($ave >=75) {
                    return "Passed";
                }
                else
                {
                    return "Failed";
                }
            }

               
?>