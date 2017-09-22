<?php
/**
 * Product object
 */
class Product
{
    // database connection and table name
    private $conn;
    private $table_name = "products";

    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    // constructor $db sebagai database koneksi
    public function __construct($db)
    {
    	$this->conn = $db;
    }

    // method membaca produk
    function read()
    {
    	// query semua data
    	$query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM " . $this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created DESC";

    	// prepare query statement
    	$stmt = $this->conn->prepare($query);

    	// execute
    	$stmt->execute();
    	return $stmt;
    }
}