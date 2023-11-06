<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
  //get form data
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $discription = filter_var($_POST['discription'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
  if(!$title) {
    $_SESSION['add-category'] = "Enter title";
  } elseif (!$discription) {
    $_SESSION['add-category'] = "Enter discription";
  }
  
  //redirect back to add category page with form data if there was invalid input
  if(isset($_SESSION['add-category'])) {
    $_SESSION['add-category-data'] = $_POST;
    header('location:' . ROOT_URL . 'admin/add-category.php');
    die();
  } else {
    //insert category into database
    $query = "INSERT INTO categories (title, discription) VALUES ('$title', '$discription')";
    $result = mysqli_query($connection, $query);
    if(mysqli_errno($connection)) {
      $_SESSION['add-category'] = "Couldn't add category";
      header('location:' . ROOT_URL . 'admin/add-category.php');
      die();
    } else {
      $_SESSION['add-category-success'] = "$title category added successfully";
      header('location:' . ROOT_URL . 'admin/manage-category.php');
      die();
    
    }
  }

}
?>
