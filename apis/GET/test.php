<?php 

  // Headers
  //header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../controller/Controller.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $post = new Post($db);

  // Blog post query
  $result = $post->average();
  
  // Get row count
  $num = $result->rowCount();
  
  $wth_temp =0;
  $wth_hum =0;
  $solar =0;
  $gas =0;
  $soil_temp =0;
  $soil_mois =0;
  $create='';
  
  // Check if any posts
  if($num > 0) 
  {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
      extract($row);
      $post_item = array(
        'weather_temperature' => $weather_temperature, 
        'weather_humidity' => $weather_humidity, 
        'solar_radiation' => $solar_radiation, 
        'gas_percentage' => $gas_percentage, 
        'soil_moisture' => $soil_moisture, 
        'soil_temperature' => $soil_temperature, 
        'created_at' => $created_at
      );

      $wth_temp  += $post_item["weather_temperature"];
      $wth_hum  += $post_item["weather_humidity"];
      $solar  += $post_item["solar_radiation"];
      $gas  += $post_item["gas_percentage"];
      $soil_temp  += $post_item["soil_temperature"];
      $soil_mois += $post_item["soil_moisture"];
      $create= $nowFormat = date('Y-m-d H:i:s');
          
    }
    
    $wth_temp = $wth_temp/10;
    $wth_hum = $wth_hum/10;
    $solar = $solar/10;
    $gas = $gas/10;
    $soil_temp = $soil_temp/10;
    $soil_mois =$soil_mois/10;
    $soil_mois = number_format($soil_mois, 2, '.', ''); // convert to float with 2 decimals
        
    $post_item = array(
    'weather_temperature' => $wth_temp, 
    'weather_humidity' => $wth_hum, 
    'solar_radiation' => $solar, 
    'gas_percentage' => $gas, 
    'soil_moisture' => $soil_mois, 
    'soil_temperature' => $soil_temp, 
    'created_at' => $create
     );
    
    array_push($posts_arr, $post_item);
  
    // Turn to JSON & output
    echo json_encode($posts_arr, JSON_PRETTY_PRINT);

  } 
  else 
  {
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }