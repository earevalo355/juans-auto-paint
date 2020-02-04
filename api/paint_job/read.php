<?php  

//Headers
header('Access-Control-Allow-Origin: *');
header('Contetnt-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/PaintJobs.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate Color Object
$paint_job = new PaintJob($db);

//Color query
$result = $paint_job->read();
//Get row Count
$num = $result->rowCount();


$paint_jobs_arr = array();
$paint_jobs_arr1= array();


$count = 0;
while ($row =$result->fetch(PDO::FETCH_ASSOC)) {
	$count++;
    //Push to 'data'

    if ($count < 6) {
   		array_push($paint_jobs_arr, $row);
    } else {
    	array_push($paint_jobs_arr1, $row);
    }
}
//Turn to JSON & output
$result = array();
$result["paint_jobs_arr"] = $paint_jobs_arr;
$result["paint_jobs_arr1"] = $paint_jobs_arr1;
echo json_encode($result);

