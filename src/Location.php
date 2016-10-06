<?php

    function roundFloat($input, $precision)
    {
        $float_input = round($input, $precision, PHP_ROUND_HALF_EVEN);
        return $float_input;
    }


    class Location
    {
        private $longitude;
        private $latitude;

        function __construct($longitude, $latitude)
        {
            $this->longitude = roundFloat($longitude, 6);
            $this->latitude = roundFloat($latitude, 6);
        }

        /*===GETTERS/SETTERS===================================*/
        function getLongitude()
        {
            return $this->longitude;
        }

        function setLongitude($new_longitude)
        {
            $this->longitude = roundFloat($new_longitude, 6);
        }

        function getLatitude()
        {
            return $this->latitude;
        }

        function setLatitude($new_latitude)
        {
            $this->latitude = roundFloat($new_latitude, 6);
        }



        function getLocation()
        {
            $location = [$this->getLongitude, $this->getLatitude];
            return $location;
        }

        
    }

 ?>
