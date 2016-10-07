<?php

    class Location
    {
        private $latitude;
        private $longitude;

        function __construct($latitude, $longitude)
        {
            //NOTE: CAN BE NULL
            $this->setLatitude($latitude);
            $this->setLongitude($longitude);
        }


        static function formatGeoString($input, $precision, $total_digits=null)
        {
            if (is_numeric($precision))
            {
                $format_string = "%'.0" . $precision . "f";
            }
            else
            {
                print("\nERROR: PRECISION IS NON NUMERIC\n");
                return null;
            }

            $input_type = gettype($input);
            if ($input_type === "string")
            {
                if (is_numeric($input))
                {
                    $formatted_input_string = sprintf($format_string, $input);


                    if (is_numeric($total_digits))
                    {
                        $max_base_ten_exponent = $total_digits - $precision;
                        $max = pow(10, $max_base_ten_exponent);
                        $min = $max * (-1);

                        $string_float_value = (float) $formatted_input_string;

                        //CHECK THAT THE FORMAT IS IN RANGE
                        if ( $string_float_value >= $max || $string_float_value <= $min)
                        {
                            print("\nERROR: INPUT IS OUT OF RANGE\n");
                            return null;
                        }
                    }

                }
                else
                {
                    print("\nERROR: INPUT IS NON NUMERIC\n");
                    return null;
                }
            }
            else if ($input_type === "integer" || $input_type === "double")
            {
                if (is_numeric($input))
                {
                    $formatted_input_string = sprintf($format_string, $input);

                    if (is_numeric($total_digits))
                    {
                        $max_base_ten_exponent = $total_digits - $precision;
                        $max = pow(10, $max_base_ten_exponent);
                        $min = $max * (-1);

                        $string_float_value = (float) $formatted_input_string;

                        //CHECK THAT THE FORMAT IS IN RANGE
                        if ( $string_float_value >= $max || $string_float_value <= $min)
                        {
                            print("\nERROR: INPUT IS OUT OF RANGE\n");
                            return null;
                        }
                    }
                }
                else
                {
                    $formatted_input_string = sprintf($format_string, $input);
                }
            }
            else
            {
                return null;
            }

            return $formatted_input_string;
        }


        static function formatGeoFloat($input, $precision, $total_digits=null)
        {
            $location_string = self::formatGeoString($input, $precision, $total_digits);

            if ($location_string)
            {
                return (float) $location_string;
            }
            else
            {
                return $location_string;
            }
        }


        /*===GETTERS/SETTERS===================================*/
        function getLongitude()
        {
            return $this->longitude;
        }

        function setLongitude($new_longitude)
        {
            $this->longitude = self::formatGeoString($new_longitude, 6, 10);

            //CHECK IF NULL
            return $this->longitude;
        }

        function getLatitude()
        {
            return $this->latitude;
        }

        function setLatitude($new_latitude)
        {
            $this->latitude = self::formatGeoString($new_latitude, 6, 10);

            //CHECK IF NULL
            return $this->latitude;
        }


        function getPositionArray()
        {
            $location = [$this->getLatitude(), $this->getLongitude()];
            return $location;
        }

        static function deleteAll()
        {
            $GLOBALS['CPDB']->exec("DELETE FROM locations;");
        }


    }

 ?>
