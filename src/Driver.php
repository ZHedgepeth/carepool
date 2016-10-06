<?php

    require_once(__DIR__ . "/../src/Rider.php");
    require_once(__DIR__ . "/../src/Location.php");

    $drivers_table_name = "drivers";

    class Driver
    {
        private $name;
        private $id;
        private $location;

        // private $username;
        // private $password;
        //
        // private $current_riders;
        // private $current_trip;
        // private $trip_history;
        //
        // private $biography;
        // private $profile_picture;

        function __construct($name, $location=null, $id=null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->id = $id;
        }

        /*===GETTERS/SETTERS===================================*/
        function getId()
        {
            return (int) $this->id;
        }

        function getName()
        {
            return (string) $this->name;
        }

        function setName($new_name)
        {
            $new_name = (string) $new_name;
            $this->name = $new_name;
            $id = $this->getId();

            $table = $GLOBALS['drivers_table_name'];
            $sql_update_name = "UPDATE " . $table . " SET name = " . $new_name . "  WHERE id = " . $id . ";";
            $GLOBALS['CPDB']->exec($sql_update_name);
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }




    }

 ?>
