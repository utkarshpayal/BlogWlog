<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $discription = filter_var($_POST['discription'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
  //validate input
  if(!$title || !$discription) {
    $_SESSION['edit-category'] = "Invalid form input on edit category page";
  } else {
    $query = "UPDATE categories SET title='$title', discription='$discription' WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    
    if(mysqli_errno($connection)) {
      $_SESSION['edit-category'] = "Couldn't update category";
    } else {
      $_SESSION['edit-category-success'] = "Category $title was updated successfully";
    }
  }
  
  
}

header('location:' . ROOT_URL . 'admin/manage-category.php');
die();

?>
