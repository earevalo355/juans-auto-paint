<?php  

//Headers
header('Access-Control-Allow-Origin: *');
header('Contetnt-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/PaintJobs.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate PaintJob Object
$color = new PaintJob($db);

//Color query
$result = $color->readTotalBlueCars();
//Get row Count
$num = $result->rowCount();

$num_arr = array();
$num_arr['data'] = array();

if ($num > 0) {
	$all_blue_cars_painted = array(
    		'all_painted_blue_cars' => "$num"
    );
	array_push($num_arr['data'], $all_blue_cars_painted);
	echo json_encode($num_arr);
} else {
	$all_blue_cars_painted = array(
    		'all_painted_blue_cars' => "0"
    );
    array_push($num_arr['data'], $all_blue_cars_painted);
	echo json_encode($num_arr);
}
//Turn to JSON & output
