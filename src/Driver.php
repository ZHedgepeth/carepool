<?php

    require_once(__DIR__ . "/../src/Rider.php");
    require_once(__DIR__ . "/../src/Location.php");

    $drivers_table_name = "drivers";
    $drivers_riders_table_name = "drivers_riders";
    $drivers_dTrips = "drivers_dTrips";

    include "database.php";

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


            print("\nlastInsertId:\n");
            var_dump($GLOBALS['CPDB']->lastInsertId());
            print("\n");

            $this->id = $GLOBALS['CPDB']->lastInsertId();
        }

        static function getAll()
        {
            $table = $GLOBALS['drivers_table_name'];

            $sql_get_all_command = "SELECT * from " . $table . ";";

            $all_drivers_PDOStatement = $GLOBALS['CPDB']->query($sql_get_all_command);

            print("\nPDOStatement:\n");
            var_dump($all_drivers_PDOStatement);
            print("\n");

            $all_drivers = [];

            if ($all_drivers_PDOStatement)
            {
                $all_drivers_data = $all_drivers_PDOStatement->fetchAll();

                for ($driver_index = 0; $driver_index < count($all_drivers_data); $driver_index++)
                {
                    $current_driver = $all_drivers_data[$driver_index];

                    $name = $current_driver['name'];

                    $latitude = $current_driver['lat'];
                    $longitude = $current_driver['lng'];

                    $location = new Location($latitude, $longitude);

                    $id = $current_driver['id'];

                    $current_driver_object = new Driver($name, $location, $id);

                    $all_drivers[] = $current_driver_object;
                }
            }
            return $all_drivers;
        }


        static function deleteAll()
        {
            $GLOBALS['CPDB']->exec("DELETE FROM drivers;");
        }

    }

 ?>
