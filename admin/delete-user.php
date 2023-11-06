<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch user from the database
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name; 

        // Delete the image if available
        if (file_exists($avatar_path)) {
            unlink($avatar_path);
        }
        
        // FOR LATER: Fetch all thumbnails of the user's posts and delete them
        $thumbnails_query = "DELETE thumbnail FROM posts WHERE author_id=$id";
        $thumbnails_result = mysqli_query($connection, $thumbnails_query);
        if(mysqli_num_rows($thumbnails_result) > 0) {
          while($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            //delete thumbnail from images folder if exists
            if($thumbnail_path) {
              unlink($thumbnail_path);
            }
          }
        
        
        }
        
        
        
        // Delete the user from the database
        $delete_user_query = "DELETE FROM users WHERE id=$id";
        $delete_user_result = mysqli_query($connection, $delete_user_query);

        if ($delete_user_result) {
            $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} deleted successfully";
        } else {
            $_SESSION['delete-user'] = "Couldn't delete {$user['firstname']} {$user['lastname']}";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-user.php');
die();
?>
