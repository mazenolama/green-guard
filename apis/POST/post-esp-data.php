<?php

header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, x-file-name");
header('Access-Control-Allow-Methods: POST');

$servername = "remotemysql.com";
$dbname = "F0SaNkPCly";
$username = "F0SaNkPCly";
$password = "FJ2YKUB7gW";


$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $weather_temperature = $weather_humidity = $solar_radiation = $gas_percentage = $gas_class = $soil_moisture = $soil_temperature = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        
        $weather_temperature = test_input($_POST["weather_temperature"]);
        $weather_humidity = test_input($_POST["weather_humidity"]);
        $solar_radiation= test_input($_POST["solar_radiation"]);
        $gas_percentage = test_input($_POST["gas_percentage"]);
        $gas_class = test_input($_POST["gas_class"]);
        $soil_moisture = test_input($_POST["soil_moisture"]);
        $soil_temperature = test_input($_POST["soil_temperature"]);

        $conn =  new mysqli($servername, $username, $password,$dbname);
 
        // Check connection
        if($conn=== false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
         
        // Print host information
        echo "Connect Successfully. Host info: " . mysqli_get_host_info($conn);
        
        $sql = "INSERT INTO SensorData ( weather_temperature, weather_humidity, solar_radiation, gas_percentage,gas_class, soil_moisture, soil_temperature) 
        VALUES ('" . $weather_temperature . "', '" . $weather_humidity . "','" . $solar_radiation . "',
        '" . $gas_percentage . "','" . $gas_class . "','" . $soil_moisture . "','" . $soil_temperature . "')";
    
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "\n \t No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}