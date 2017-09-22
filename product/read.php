<?php
// require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object file
include_once '../config/database.php';
include_once '../objects/product.php';

// instansiasi object atau membuat object dari class
$database = new Database();
$db = $database->getConnection();

// inisialisasi object product
$product = new Product($db);

// query product
$stmt = $product->read();
$num = $stmt->rowCount();

// check jika ada isi dari table / rows
if ($num>0) {
	// product array
	$products_arr = array();
	$products_arr["records"]= array();

	// retrieve our table content
	// fecth is faster that fechtall lebih wuzzzzzzzzz
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    // extract $row
	    // this will make $row['name'] to
	    // just $name only
		extract($row);

		$product_item = array(
			"id" => $id,
			"name" => $name,
			"description" => html_entity_decode($description),
			"price" => $price,
			"category_id" => $category_id,
			"category_name" => $category_name
		);
		array_push($products_arr["records"], $product_item);
	}
	echo json_encode($products_arr);
}

else {
	echo json_encode(
		array("message" => "No Product Founds")
	);
}
?>