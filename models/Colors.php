<?php

class Color
{
	//DB Stuff
    private $conn;
    private $table ='color_tbl';

    //Color Properties
    public $id;
    public $color_name;
    public $created_at;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Color
    public function read(){
    		//Create Query
	    	$query = 'SELECT 
	    	id,
	    	color_name,
	    	created_at
    	FROM
	    	' .$this->table . ' ORDER BY created_at DESC';
	//Prepared statement
	$stmt = $this->conn->prepare($query);

	//Execute query
	$stmt->execute();

	return $stmt;
    }
}