<?php

$connection =mysqli_connect("localhost","root","root");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create database
$mysql="CREATE DATABASE Userinfo";
if (mysqli_query($connection,$mysql))
  {
  echo "Database my_db created successfully";
  }
else
  {
  echo "Error creating database: " . mysqli_error($connection);
  }


?>

<?php
$connection =mysqli_connect("localhost","root","root","Userinfo");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$mysql="CREATE TABLE User
(
Username varchar(15),
Password varchar(15),
Gender varchar(15),
Age int,
Favoritefood1 varchar(15),
Favoritefood2 varchar(15),
extra1 varchar(15),
extra2 varchar(15),
)";

// Execute query
if (mysqli_query($connection,$mysql))
  {
  echo "Table userinfo created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($connection);
  }


?>