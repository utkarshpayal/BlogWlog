<?php
require 'config/database.php';

// Start the session
session_start();

// Make sure the "submit" button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // Set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ? 1 : 0;

    // Check and validate input values
    if (!$title || !$category_id || !$body) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page.";
    } else {
        // Check if a new thumbnail was uploaded
        if (!empty($thumbnail['name'])) {
            $thumbnail_destination_path = '../images/' . basename($thumbnail['name']);

            if (move_uploaded_file($thumbnail['tmp_name'], $thumbnail_destination_path)) {
                $thumbnail_to_insert = basename($thumbnail['name']);
                
                // Delete the previous thumbnail if it exists
                if (file_exists('../images/' . $previous_thumbnail_name)) {
                    unlink('../images/' . $previous_thumbnail_name);
                }
            } else {
                $_SESSION['edit-post'] = "Couldn't update post. Failed to move the uploaded file.";
            }
        } else {
            $thumbnail_to_insert = $previous_thumbnail_name;
        }

        // Update the database using prepared statements
        $query = "UPDATE posts SET title=?, body=?, thumbnail=?, category_id=?, is_featured=? WHERE id=?";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssii', $title, $body, $thumbnail_to_insert, $category_id, $is_featured, $id);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['edit-post-success'] = "Post updated successfully";
            } else {
                $_SESSION['edit-post'] = "Couldn't update post. Error executing SQL query.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['edit-post'] = "Couldn't update post. Error preparing SQL statement.";
        }
    }
}

// Redirect to the manage post page
header('location: ' . ROOT_URL . 'admin/');
exit();
?>
