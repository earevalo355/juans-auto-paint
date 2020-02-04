<?php  
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


	include_once '../../config/Database.php';
	include_once '../../models/PaintJobs.php';

	//Installation DB & connect
	$database = new Database();
	$db = $database->connect();

	//Instantiate Paint Job object
	$paint_job = new PaintJob($db);

	// Get raw Paint Job data 
	$data = json_decode(file_get_contents("php://input"));

	$paint_job->id = $data->id;
	$paint_job->completed = $data->completed;

	//Update Status Paint Job 
	if ($paint_job->update()) {
		echo json_encode(
			array('message' => 'Job Successfully Completed')
		);
	} 
	else {
		echo json_encode(
			array('message' => 'Paint Job Not Completed')
		);
	}