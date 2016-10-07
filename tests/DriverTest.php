<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Driver.php";
    require_once "src/Location.php";

    include "database_test.php";

    class DriverTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Driver::deleteAll();
        }

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
            $latitude = "47.60894143";
            $longitude = "-122.340145242";

            $name = "Snickerbar Snackerdomes";
            $location = new Location($latitude, $longitude);

            if ($location->getLatitude() && $location->getLongitude())
            {


                $test_driver = new Driver($name, $location);

                //ACT
                $test_driver->save();

                print("\ntest_driver:\n");
                var_dump($test_driver);
                print("\n");

                $expected_output = $test_driver;

                $all_drivers = Driver::getAll();
                $result = $all_drivers[0];

                //ASSERT
                $this->assertEquals($expected_output, $result);
            }
            else
            {
                //ARRANGE
                $expected_output = [null, null];

                //ACT
                $result = $location->getPositionArray();

                //ASSERT
                $this->assertEquals($expected_output, $result);
            }
        }
    }

?>
