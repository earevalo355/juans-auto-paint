<?php  

//Headers
header('Access-Control-Allow-Origin: *');
header('Contetnt-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Colors.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate Color Object
$color = new Color($db);

//Color query
$result = $color->read();
//Get row Count
$num = $result->rowCount();

//Check if any Color

if ($num > 0) {
	$products_arr = array();
	$products_arr['data'] = array();

	while ($row =$result->fetch(PDO::FETCH_ASSOC)) {
	    extract($row);

	    $product_item = array(
	    	'id' => $id,
	    	'color_name' => $color_name
	    );
	    //Push to 'data'
	    array_push($products_arr['data'], $product_item);
	}
	//Turn to JSON & output
	echo json_encode($products_arr);
} else {
	//No Color
	echo json_encode(
		array('message' => 'No Any Colors Found')
	);
}