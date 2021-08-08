<?php include "template.php"; ?>
<title>User Profile</title>

<h1 class='text-primary'>Profile Page</h1>
<?php

echo  $_SESSION["user_id"];
echo "<br>";
echo $_SESSION["name"];
echo "<br>";
echo  $_SESSION["username"];
echo "<br>";
echo $_SESSION["level"];
echo "<br>";

$query=$conn->query("SELECT profilePic FROM 'user'") or die("Failed to fetch row!");
while($data=$query->fetchArray());
echo "<img src='uploads/".$d1."' width='500' height='600' >";
?>


