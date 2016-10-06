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

        function save()
        {
            $name = $this->getName();
            $location_object = $this->getLocation();

            $location = $location_object->getPositionArray();
            $longitude = $location[0];
            $latitude = $location[1];

            $table = $GLOBALS['drivers_table_name'];

            $sql_save_command = "INSERT INTO " . $table . " (name , lat, lng) VALUES (" . $name . ", " . $latitude . ", " . $longitude . ");";

            $GLOBALS['CPDB']->exec($sql_save_command);

            $this->id = $GLOBALS['CPDB']->lastInsertId();
        }

        static function getAll()
        {
            $table = $GLOBALS['drivers_table_name'];
            $sql_get_all_command = "SELECT * from " . $table . ";";
            $returned_drivers = $GLOBALS['CPDB']->query($sql_get_all_command);
            $drivers = array();
            foreach ($returned_drivers as $driver)
            {
                $name = $driver['name'];
                $latitude = $driver['lat'];
                $longitude = $driver['lng'];
                $location = [$latitude, $longitude];
                $id = $driver['id'];
                $new_driver = new Driver($name, $location, $id);
                array_push($drivers, $new_driver);
            }
            var_dump($drivers);
            return $drivers;
        }

    }

 ?>
