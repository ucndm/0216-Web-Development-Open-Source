<?php
//HTTP headers
	header('Content-type: application/json');

	//variables
	$message = new stdClass();
	$message->alert = '';
	$links = array();

	try {
		//db connection
		$conn = new PDO('mysql:host=localhost;dbname=links', 'test_user', 'test_user_pw');

		//inserting new links
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(array_key_exists('url',$_POST) && array_key_exists('title',$_POST)){
				if($_POST['title'] != '' && $_POST['url'] != ''){
					$insert = $conn->prepare("INSERT INTO link (url, title) VALUES (:url, :title)");
					$insert->bindParam(":url", $_POST['url'], PDO::PARAM_STR, 256);
					$insert->bindParam(":title", $_POST['title'], PDO::PARAM_STR, 256);

					if($insert->execute()){
						$message->alert = "Link created!";
						$message->id = $conn->lastInsertId();
					}
				}else{
					$message->alert = 'You need both title and url';
				}
			}
		}

		//collecting links from db
		//$select = $conn->prepare("SELECT * FROM link");
		//$select->execute();
		//$links = $select->fetchAll(PDO::FETCH_CLASS, "Link");

	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	class Link
	{
		public $id;
		public $url;
		public $title;
		function __construct()
		{
		}
	}
	echo json_encode($message);
?>