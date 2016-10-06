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
    $DB = new PDO($server, $username, $password);

    class DriverTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            //Arrange
            $longitude = 3.451351451341413;
            $latitude = 1.231414134134;

            $id = 1;
            $name = "Sam";
            $location = new Location($longitude, $latitude);
            $test_driver = new Driver($name, $location, $id);
            var_dump($location);
            //Act
            $result = $test_driver->getName();
            //Assert
            $this->assertEquals($name, $result);
        }
    }

?>
