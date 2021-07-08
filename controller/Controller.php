<?php 
  class Post 
  {
    // DB stuff
    private $conn;

    // Post Properties
    public $id;
    
    public $mode;
    public $state;
    
    public $weather_temperature; 
    public $weather_humidity; 
    public $solar_radiation; 
    public $gas_percentage; 
    public $gas_class; 
    public $soil_moisture; 
    public $soil_temperature; 
    
    public $admin_id;
        
    public $created_at;
    public $updated_at;
    
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

   // Get Posts
    public function read($table) 
    {
      // Create query
      $query = 'SELECT * FROM '.$table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    // Get pump state
    public function read_pump($table) 
    {
      // Create query
      $query = 'SELECT * FROM '.$table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() 
    {
      // Create query
      $query = 'SELECT *
                FROM pump
                WHERE
                id = ?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->weather_temperature = $row['weather_temperature'];
      $this->weather_humidity = $row['weather_humidity'];
      $this->solar_radiation = $row['solar_radiation'];
      $this->gas_percentage = $row['gas_percentage'];
      $this->gas_class = $row['gas_class'];
      $this->soil_moisture = $row['soil_moisture'];
      $this->soil_temperature = $row['soil_temperature'];
      $this->created_at = $row['created_at'];
        
    }



    // Update Post
    public function up() 
    {
        if(isset($this->mode) && $this->state && $this->admin_id)
        {
            // Create query
            $query = 'UPDATE pump
                      SET state = :state, mode = :mode, updated_at = current_timestamp
                      WHERE admin_id = :admin_id';
        
            // Prepare statement
          $stmt = $this->conn->prepare($query);
        
          // Clean data
          $this->mode = htmlspecialchars(strip_tags($this->mode));
          $this->state = htmlspecialchars(strip_tags($this->state));
          $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
    
          // Bind data
          $stmt->bindParam(':mode', $this->mode);
          $stmt->bindParam(':state', $this->state);
          $stmt->bindParam(':admin_id', $this->admin_id);
    
          // Execute query
          if($stmt->execute()) 
          {
            return true;
          }
        }
        
        else
        {
           return false;
        }
    }
        
    // Update analyzed data
    public function update_analysis() 
    {
        if(isset($this->admin_id) && $this->state )
        {
            // Create query
            $query = 'UPDATE analyzedData
                      SET state = :state, updated_at = current_timestamp
                      WHERE admin_id = :admin_id';
    
    
            // Prepare statement
            $stmt = $this->conn->prepare($query);
        
            // Clean data
            //$this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
            $this->state = htmlspecialchars(strip_tags($this->state));
            $this->admin_id = htmlspecialchars(strip_tags($this->admin_id));
        
            // Bind data
            //$stmt->bindParam(':updated_at', $this->updated_at);
            $stmt->bindParam(':state', $this->state);
            $stmt->bindParam(':admin_id', $this->admin_id);
        
            // Execute query
            if($stmt->execute()) 
            {
                return true;
            }
        }
        else
            return false;
    }
    
    
    public function average() 
    {
      // Create query
      $query = 'SELECT * FROM ( SELECT * FROM SensorData ORDER BY id DESC LIMIT 10 )Var1 ORDER BY id ASC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);
     
      // Execute query
      $stmt->execute();
    
      return $stmt;
    }

  }