<?php
	// Create a Class Name
	class PaintJob
	{

		//DB STUFF
		private $conn;
		private $table = 'car_details_tbl';

		//Post Properties
		public $id;
		public $plate_number;
		public $current_color;
		public $target_color;
		public $completed;

		// Constructor with DB
		public function __construct($db){
			$this->conn = $db;
		}

		//Get Car Details
		public function read(){
			//Create Query
	    	$query = 'SELECT
	    	id, 
	    	plate_number,
	    	current_color,
	    	target_color
    	FROM
	    	' .$this->table . ' WHERE completed = 0 ORDER BY id ASC';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execucte query
		$stmt->execute();

		return $stmt;

		}

		//Get Total Cars
		public function readTotalCars(){
			//Create Query
	    	$query = 'SELECT
	    	id
    	FROM
	    	' .$this->table . ' WHERE completed = 1';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execucte query
		$stmt->execute();

		return $stmt;

		}

		//Get Total Red Cars
		public function readTotalRedCars(){
			//Create Query
	    	$query = 'SELECT
	    	id
    	FROM
	    	' .$this->table . ' WHERE completed = 1 AND target_color = "RED"';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execucte query
		$stmt->execute();

		return $stmt;

		}

		//Get Total Red Cars
		public function readTotalGreenCars(){
			//Create Query
	    	$query = 'SELECT
	    	id
    	FROM
	    	' .$this->table . ' WHERE completed = 1 AND target_color = "GREEN"';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execucte query
		$stmt->execute();

		return $stmt;

		}

		//Get Total Blue Cars
		public function readTotalBlueCars(){
			//Create Query
	    	$query = 'SELECT
	    	id
    	FROM
	    	' .$this->table . ' WHERE completed = 1 AND target_color = "BLUE"';

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Execucte query
		$stmt->execute();

		return $stmt;

		}

		// Create Car details
		public function create(){
			// Create query
			$query = 'INSERT INTO ' . 
					$this->table . '
				SET 
					plate_number = :plate_number,
					current_color = :current_color,
					target_color = :target_color,
					completed = :completed
					';

			// Prepare Statement
			$stmt = $this->conn->prepare($query);

			//Clean data
			$this->plate_number = htmlspecialchars(strip_tags($this->plate_number));
			$this->current_color = htmlspecialchars(strip_tags($this->current_color));
			$this->target_color = htmlspecialchars(strip_tags($this->target_color));
			$this->completed = htmlspecialchars(strip_tags($this->completed));
		

			//Bind data
			$stmt->bindParam(':plate_number', $this->plate_number);
			$stmt->bindParam(':current_color', $this->current_color);
			$stmt->bindParam(':target_color', $this->target_color);
			$stmt->bindParam(':completed', $this->completed);

			//Execute query
			if ($stmt->execute()) {
				return true;
			}

			//Print error id something goes wrong
			printf("Error: %s.\n", $stmt->error);

				return false;
		}


		//Update Paint jobs in progress Status
   	 	public function update(){
        // Create query
        $query = 'UPDATE ' . 
                $this->table . '
            SET 
                completed = :completed
            WHERE 
                id = :id';

	        // Prepare Statement
	        $stmt = $this->conn->prepare($query);

	        //Clean data
	        $this->id = htmlspecialchars(strip_tags(trim($this->id)));
	        $this->completed = htmlspecialchars(strip_tags(trim($this->completed)));

	        //Bind data
	        $stmt->bindParam(':id', $this->id);
	        $stmt->bindParam(':completed', $this->completed);

	        //Execute query
	        if ($stmt->execute()) {
	            return true;
	        }

	        //Print error id something goes wrong
	        printf("Error: %s.\n", $stmt->error);

	            return false;
	    }
	}

	

