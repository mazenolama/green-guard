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

  // Instantiate blog post object
  $post = new Post($db);
$table = 'SensorData';
  // Blog post query
  $result = $post->read($table);
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
    
      $post_item = array(
        'id' => $id,
        'weather_temperature' => $weather_temperature, 
        'weather_humidity' => $weather_humidity, 
        'solar_radiation' => $solar_radiation, 
        'gas_percentage' => $gas_percentage, 
        'gas_class' => $gas_class, 
        'soil_moisture' => $soil_moisture, 
        'soil_temperature' => $soil_temperature, 
        'created_at' => $created_at
      );

    
      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr, JSON_PRETTY_PRINT);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
