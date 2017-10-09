<?php
require("../connect_db.php");

if (isset($_POST['del'])){
  $id = $_POST['del'];
  echo $id;
  $query = "DELETE FROM products WHERE id='$id'";
  mysqli_query($link,"$query");
};
