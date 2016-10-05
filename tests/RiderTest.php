<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    // require_once "src/Driver.php";
    require_once "src/Rider.php";

    $server ='mysql:host=localhost:8889;dbname=carepool_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RiderTest extends PHPUnit_Framework_TestCase
    {
        function testGetId()
        {
            //Arrange
            $id = 1;
            $name = "Kyle";
            $test_rider = new Rider($id, $name);
            //Act
            $result = $test_rider->getId();
            //Assert
            $this->assertEquals(1, $result);
        }
        function testGetName()
        {
            //Arrange
            $id = 1;
            $name = "Sam";
            $test_rider = new Rider($id, $name);
            //Act
            $result = $test_rider->getName();
            //Assert
            $this->assertEquals($name, $result);
        }
        function testSetName()
        {
            //Arrange
            $id = 1;
            $name = "Alex";
            $test_rider = new Rider($id, $name);
            //Act
            $test_rider->setName("Adiddas");
            $result = $test_rider->getName();
            //Assert
            $this->assertEquals("Adiddas", $result);
        }
    }


?>
