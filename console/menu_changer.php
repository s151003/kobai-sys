<?php
require("../connect_db.php");


if (isset($_POST['del'])){
  $name = $_POST['del'];
  $query = "DELETE FROM products WHERE name='$name'";
  echo $query;
  mysqli_query($link,"$query");
};
