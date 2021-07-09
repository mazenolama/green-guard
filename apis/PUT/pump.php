<?php 
  // Headers
  //header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  //header('Content-Type: text/html; charset=UTF-8');
  //header('Content-Type: application/json');
  //header('Method: PUT');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  header('Content-Type: application/json');
  
  
  include_once '../../config/Database.php';
  include_once '../../controller/Controller.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get raw posted data
  /*
    $req = file_get_contents("php://input");
    
    $obj = json_decode($req,true);
    var_dump($obj);
  */
  
  $data = json_decode(file_get_contents("php://input"));
 if(isset($data->admin_id) &&($data->state))
  {
    // Set ID to update
    $post->admin_id = $data->admin_id;
    
    $post->mode = $data->mode;
    $post->state = $data->state;
    
    
    // Update post
    if($post->up()==true) 
    {
        echo json_encode(array('message' => 'Record is Updated'));
    } 
    else 
    {
        echo json_encode(array('message' => 'Record Could Not be Update'));
    }
  }
  else
     echo json_encode(array('message' => 'please correct your params'));
  
?>