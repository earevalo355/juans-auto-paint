<?php  
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
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

	$paint_job->plate_number = $data->plate_number;
	$paint_job->current_color = $data->current_color;
	$paint_job->target_color = $data->target_color;
	$paint_job->completed = $data->completed;

	//Create Paint Job
	if ($paint_job->create()) {
		echo json_encode(
			array('message' => 'Paint Job SuccessFully Created')
		);
	} 
	else {
		echo json_encode(
			array('message' => 'Paint Job Not Created')
		);
	}