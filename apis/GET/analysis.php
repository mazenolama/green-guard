<?php 
  // Headers



  include_once '../../config/Database.php';
  include_once '../../controller/Controller.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);
  
  $table = 'analyzedData';
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
        'state' => $state, 
        'admin_id' => $admin_id, 
        'updated_at' => $updated_at
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