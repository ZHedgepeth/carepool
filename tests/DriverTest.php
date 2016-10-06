<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Driver.php";
    require_once "src/Location.php";

    $server ='mysql:host=localhost:8889;dbname=carepool_test';
    $username = 'root';
    $password = 'root';
    $CPDB = new PDO($server, $username, $password);

    class DriverTest extends PHPUnit_Framework_TestCase
    {
        function test_getName()
        {
            //Arrange
            $latitude = 1.231414134134;
            $longitude = 3.451351451341413;

            $id = 1;
            $name = "Sam";
            $location = new Location($latitude, $longitude);
            $test_driver = new Driver($name, $location, $id);
            //Act
            $result = $test_driver->getName();
            //Assert
            $this->assertEquals($name, $result);
        }


        function test_save()
        {
            //ARRANGE
            $latitude = "47.608941";
            $longitude = "-122.340145";

            $name = "Snickerbar Snackerdomes";
            $location = new Location($latitude, $longitude);
            $test_driver = new Driver($name, $location);

            //ACT
            $test_driver->save();
            $expected_output = $test_driver;

            $all_drivers = Driver::getAll();
            $result = $all_drivers[0];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }
    }

?>
