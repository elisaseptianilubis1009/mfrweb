<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

/*$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
*/

include "koneksi.php"; 
$input1=$_GET['param1'];
$input2=$_GET['param2'];

$data=file_get_contents("php://input");
	if((file_put_contents(rand().".jpg",$data))){
	
	echo "upload complete"." Data ".$input1." & ".$input2;

	// $mysqli="INSERT INTO db_data (id,first_name,last_name,image) VALUES ('','$input1','$input2','$data')";
	// mysqli_query($connect,$mysqli);

	// $select="select * from db_data";
	// $query=mysqli_query($connect,$select);
	
	// if(!$query){
	// 		die ('SQL Error :'.mysqli_error($connect));
	// }

	// while ($row=mysqli_fetch_array($query)){

	// 	echo $row['id'];
	// 	echo $row['first_name'];
	// 	echo $row['last_name'];
	// 	echo $row['image'];
	// }
	// echo "Input Berhasil"; 
}else{
        echo "upload gagal"." Data ".$input1." & ".$input2;

    }
?>
