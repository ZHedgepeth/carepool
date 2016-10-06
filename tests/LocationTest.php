<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Location.php";

    $server ='mysql:host=localhost:8889;dbname=carepool_test';
    $username = 'root';
    $password = 'root';
    $CPDB = new PDO($server, $username, $password);

    class LocationTest extends PHPUnit_Framework_TestCase
    {
        function test_formatGeo()
        {
            //Arrange
            $input1 = "123.456789";
            $input2 = "-123.456789";
            $input3 = "1234.567891";
            $input4 = "-1234.56789123";
            $input5 = "-0.4564";
            $input6 = "0000.34634634";
            $input7 = 123.456789;
            $input8 = -1413435353;
            $input9 = 0.000325;
            $input10 = 9999.999999;
            $input11 = -9999.9999;
            $input12 = 10000;
            $input13 = -10000.339;
            $input14 = [$input1, $input6, $input8];

            $input_array = [$input1, $input2, $input3, $input4, $input5, $input6, $input7, $input8, $input9, $input10, $input11, $input12, $input13, $input14];

            $expected_output = [
                "123.456789",
                "-123.456789",
                "1234.567891",
                "-1234.567891",
                "-0.456400",
                "0.346346",
                "123.456789",
                null,
                "0.000325",
                "9999.999999",
                "-9999.999900",
                null,
                null,
                null
            ];
            //Act
            $result = [];

            for($input_index = 0; $input_index < count($input_array); $input_index++)
            {
                $current_input = $input_array[$input_index];

                $formatted_input_string = Location::formatGeo($current_input, 6, 10);

                $result[] = $formatted_input_string;
            }

            //Assert
            $this->assertEquals($expected_output, $result);
        }
    }


?>
