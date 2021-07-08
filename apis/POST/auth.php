<?php 

 /* header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");*/

 
$servername = "remotemysql.com";

$dbname = "F0SaNkPCly";

$username = "F0SaNkPCly";

$password = "FJ2YKUB7gW";

$con = mysqli_connect($servername, $username, $password ,$dbname);
 
if($con){
    
    
    $output = array('flag'=>0,'msg'=>'Incorrect Email or Password ' ,  'info'=>'');

    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $sql = mysqli_query($con,"select * from admins where email = '". $_POST['email']."' and password= '". $_POST['password'] ."'  ");
        
        $results = array();
        while($row = mysqli_fetch_array($sql))
        {
            $results[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email']
            );
            $output['flag']=1;
            $output['msg']="successed login";
            $output['info'] = $results;
            echo json_encode( $output, JSON_PRETTY_PRINT);
        }
    }
    else
    {
        $results[] = array(
            'id' => '',
            'name' => '',
            'email' => ''
        );
        $output['info'] = $results;
        echo json_encode( $output, JSON_PRETTY_PRINT);
    }
}
else{
    echo "failed to connect";
}
