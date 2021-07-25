<?php
session_start();

$conn = new SQLite3("Alekz") or die ("unable to open datebase");
$query = file_get_contents("sql/create-user.sql");
$stmt = $conn->prepare($query);
$stmt->execute();
?>