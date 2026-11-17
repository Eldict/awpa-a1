<h1>Adding Students Data to Database</h2>



<?php

/* Copy this page to your server and view through a browser */

/* Add your database login details here before viewing the page */

/* Uses the same connection file as the rest of the site,
   so the login details only live in one place (dbConnect.php) */
include "dbConnect.php";




$students = 	array (
array("img"=>"001.jpg","id" => "123423123",  "address" => "Cork", "mark" => 45 ),
array("img"=>"002.jpg","id" => "254332445",  "address" => "Limerick", "mark" => 90 ),
array("img"=>"003.jpg","id" => "898977897",  "address" => "Cork", "mark" => 05 ),
array("img"=>"004.jpg","id" => "124636366",  "address" => "Galway", "mark" => 33 ),
array("img"=>"005.jpg","id" => "908908877",  "address" => "Belfast", "mark" => 39 ),
array("img"=>"006.jpg","id" => "234322343",  "address" => "Belfast", "mark" => 65 ),
array("img"=>"007.jpg","id" => "231678523",  "address" => "Fermoy", "mark" => 62 ),
array("img"=>"008.jpg","id" => "123456789",  "address" => "Cork", "mark" => 43 ),
array("img"=>"009.jpg","id" => "987654321",  "address" => "Cork", "mark" => 94 ),
array("img"=>"010.jpg","id" => "543216789",  "address" => "Dublin", "mark" => 25 ),
array("img"=>"011.jpg","id" => "284634553",  "address" => "Dublin", "mark" => 89 ),
array("img"=>"012.jpg","id" => "236213543",  "address" => "Limerick", "mark" => 74 ),
array("img"=>"013.jpg","id" => "090909324",  "address" => "Sligo", "mark" => 41 ),
array("img"=>"014.jpg","id" => "023989374",  "address" => "Sligo", "mark" => 45 ),
array("img"=>"015.jpg","id" => "234230234",  "address" => "Cashel", "mark" => 90 ),
array("img"=>"016.jpg","id" => "234234244",  "address" => "Galway", "mark" => 65 ),
array("img"=>"017.jpg","id" => "234234321",  "address" => "Limerick", "mark" => 57 ),
array("img"=>"018.jpg","id" => "898798987",  "address" => "Tralee", "mark" => 32 ),
array("img"=>"019.jpg","id" => "677436767",  "address" => "Kilarney", "mark" => 11 ),
array("img"=>"020.jpg","id" => "786756455",  "address" => "Tralee", "mark" => 56 ),
array("img"=>"021.jpg","id" => "217904355",  "address" => "Tralee", "mark" => 78 ),
array("img"=>"022.jpg","id" => "345430000",  "address" => "Limerick", "mark" => 60 ),
array("img"=>"023.jpg","id" => "832977987",  "address" => "Limerick", "mark" => 54 ),
array("img"=>"024.jpg","id" => "223344556",  "address" => "Cork", "mark" => 44 ),
array("img"=>"025.jpg","id" => "987654321",  "address" => "Cork", "mark" => 49 ),
array("img"=>"026.jpg","id" => "123123123",  "address" => "Cork", "mark" => 50 ),
array("img"=>"027.jpg","id" => "566546341",  "address" => "Cork", "mark" => 52 ),
array("img"=>"028.jpg","id" => "000234234",  "address" => "Dublin", "mark" => 56 ),
array("img"=>"029.jpg","id" => "000023423",  "address" => "Dublin", "mark" => 65 ),
array("img"=>"030.jpg","id" => "999912931",  "address" => "Belfast", "mark" => 62 ),
array("img"=>"031.jpg","id" => "098798673",  "address" => "Sligo", "mark" => 43 ),
array("img"=>"032.jpg","id" => "123590124",  "address" => "Sligo", "mark" => 76 ),
array("img"=>"033.jpg","id" => "121121212",  "address" => "Limerick", "mark" => 64 ),
array("img"=>"034.jpg","id" => "324435555",  "address" => "Dublin", "mark" => 69 ),
array("img"=>"035.jpg","id" => "234567345",  "address" => "Limerick", "mark" => 11 ),
array("img"=>"036.jpg","id" => "234324234",  "address" => "Sligo", "mark" => 12 ),
array("img"=>"037.jpg","id" => "567875463",  "address" => "Galway", "mark" => 50 ),
array("img"=>"038.jpg","id" => "098798776",  "address" => "Galway", "mark" => 83 ),
array("img"=>"039.jpg","id" => "333333323",  "address" => "Galway", "mark" => 65 ),
array("img"=>"040.jpg","id" => "879778933",  "address" => "Cork", "mark" => 57 )

);







ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





/* set the character set  */
$charset_set = mysqli_set_charset ($db, 'utf8');



$createquery = "CREATE TABLE `c25a1_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `address` text NOT NULL,
  `mark` int(11) NOT NULL,
  `student_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


/* echo $createquery; */



$createresult = mysqli_query ($db, $createquery);


$checkquery = "Select * from c25a1_students;";

$checkresult = mysqli_query($db, $checkquery);

$num_rows = mysqli_num_rows($checkresult);
	

echo "<h1>Addding Student Rows</h1>";

if ($num_rows < 1)
{



	foreach ($students as $student)
	{
		$query = "INSERT INTO c25a1_students (image, student_id, address, mark) VALUES (\"{$student['img']}\", \"{$student['id']}\", \"{$student['address']}\", {$student['mark']});";




		echo "<br>{$student['img']} / {$student['id']} / {$student['address']} / {$student['mark']}";
	
		
		$result = mysqli_query ($db, $query);


	
	}
}
else
{
	
	echo "Already Exists.";
	
}


$createquery = "CREATE TABLE `c25a1_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";



$createresult = mysqli_query ($db, $createquery);



$votes = array (
array ('student_id'=> '28','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '37','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '8','vote' => '5', 'user_id' => '3'),
array ('student_id'=> '27','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '38','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '40','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '11','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '33','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '6','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '21','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '29','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '39','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '20','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '31','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '11','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '26','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '25','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '6','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '37','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '8','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '38','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '16','vote' => '5', 'user_id' => '3'),
array ('student_id'=> '19','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '35','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '36','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '31','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '8','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '30','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '18','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '9','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '40','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '38','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '24','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '6','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '35','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '23','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '40','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '32','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '33','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '32','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '40','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '10','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '40','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '36','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '34','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '39','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '18','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '17','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '33','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '29','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '10','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '32','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '27','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '6','vote' => '5', 'user_id' => '3'),
array ('student_id'=> '10','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '26','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '18','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '16','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '13','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '19','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '21','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '36','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '21','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '11','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '40','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '26','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '8','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '21','vote' => '5', 'user_id' => '3'),
array ('student_id'=> '39','vote' => '5', 'user_id' => '3'),
array ('student_id'=> '10','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '34','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '38','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '39','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '18','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '38','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '30','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '15','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '12','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '6','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '18','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '13','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '8','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '15','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '34','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '23','vote' => '5', 'user_id' => '3'),
array ('student_id'=> '32','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '36','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '36','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '11','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '19','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '9','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '17','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '9','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '8','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '33','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '18','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '26','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '15','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '10','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '18','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '17','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '40','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '24','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '24','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '27','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '22','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '34','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '12','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '29','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '21','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '15','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '29','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '35','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '8','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '7','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '28','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '8','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '10','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '23','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '18','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '25','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '39','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '36','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '34','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '30','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '37','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '33','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '14','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '35','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '23','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '35','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '12','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '13','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '27','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '30','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '9','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '11','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '33','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '34','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '38','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '24','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '9','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '30','vote' => '2', 'user_id' => '3'),
array ('student_id'=> '15','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '20','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '8','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '10','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '16','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '11','vote' => '3', 'user_id' => '2'),
array ('student_id'=> '26','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '21','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '17','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '36','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '13','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '28','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '18','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '38','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '31','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '30','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '14','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '40','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '17','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '36','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '7','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '12','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '26','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '10','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '40','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '37','vote' => '0', 'user_id' => '3'),
array ('student_id'=> '33','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '14','vote' => '1', 'user_id' => '1'),
array ('student_id'=> '18','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '35','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '36','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '13','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '14','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '27','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '6','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '20','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '8','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '10','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '14','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '27','vote' => '4', 'user_id' => '2'),
array ('student_id'=> '11','vote' => '1', 'user_id' => '2'),
array ('student_id'=> '22','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '35','vote' => '4', 'user_id' => '3'),
array ('student_id'=> '8','vote' => '4', 'user_id' => '1'),
array ('student_id'=> '21','vote' => '5', 'user_id' => '1'),
array ('student_id'=> '36','vote' => '0', 'user_id' => '2'),
array ('student_id'=> '8','vote' => '5', 'user_id' => '2'),
array ('student_id'=> '38','vote' => '0', 'user_id' => '1'),
array ('student_id'=> '8','vote' => '2', 'user_id' => '1'),
array ('student_id'=> '31','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '13','vote' => '3', 'user_id' => '3'),
array ('student_id'=> '6','vote' => '3', 'user_id' => '1'),
array ('student_id'=> '35','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '18','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '29','vote' => '2', 'user_id' => '2'),
array ('student_id'=> '33','vote' => '1', 'user_id' => '3'),
array ('student_id'=> '8','vote' => '5', 'user_id' => '3') );

$checkquery = "Select * from c25a1_votes;";

$checkresult = mysqli_query($db, $checkquery);

$num_rows = mysqli_num_rows($checkresult);
	

echo "<h1>Addding Votes Rows</h1>";



if ($num_rows < 1)
{



	foreach ($votes as $vote)
	{
		$query = "INSERT INTO c25a1_votes (student_id, vote, user_id) VALUES (\"{$vote['student_id']}\", \"{$vote['vote']}\", \"{$vote['user_id']}\");";

	
		echo "<br>{$vote['student_id']} / {$vote['vote']} / {$vote['user_id']}";


		$result = mysqli_query ($db, $query);
	
	}


	echo "<p>Done";


}
else
{
	
	echo "Already Exists.";
	
}




$createquery = "CREATE TABLE `c25a1_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


$createresult = mysqli_query ($db, $createquery);




$users = array (
array ('login'=> 'user1','password' => '1234', 'name' => 'John Smith'),
array ('login'=> 'user2','password' => 'abcd', 'name' => 'Mary Brown'),
array ('login'=> 'user3','password' => 'qwerty', 'name' => 'Jo McCarthy')
);




$checkquery = "Select * from c25a1_users;";

$checkresult = mysqli_query($db, $checkquery);

$num_rows = mysqli_num_rows($checkresult);
	

echo "<h1>Addding User Rows</h1>";


if ($num_rows < 1)
{



	foreach ($users as $user)
	{
		$query = "INSERT INTO c25a1_users (login, password, name) VALUES (\"{$user['login']}\", \"{$user['password']}\", \"{$user['name']}\");";

		echo "<br>{$user['login']} / {$user['password']} / {$user['name']}";


		$result = mysqli_query ($db, $query);
	
	}


	echo "<p>Done";


}
else
{
	
	echo "Already Exists.";
	
}

?>




