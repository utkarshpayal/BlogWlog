<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    session_start();

    if (!isset($_SESSION['user-id'])) {
        $_SESSION['add-post'] = "User is not logged in";
        header('Location: ' . ROOT_URL . 'admin/add-post.php');
        exit();
    }

    $author_id = $_SESSION['user-id'];
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // Check if the user is an admin (you may need a different way to determine this)
    $is_admin = isset($_SESSION['user_is_admin']) ? $_SESSION['user_is_admin'] : false;

    // Set is_featured based on user type
    $is_featured = $is_admin ? (int) filter_input(INPUT_POST, 'is_featured', FILTER_VALIDATE_INT) : 0;

    // Validate form data
    if (!$title || !$category_id || !$body || !$thumbnail['name']) {
        $_SESSION['add-post'] = "Please fill in all required fields";
        header('Location: ' . ROOT_URL . 'admin/add-post.php');
        exit();
    }

    // Check if the uploaded file is an image
    $allowed_extensions = ['png', 'jpg', 'jpeg'];
    $extension = pathinfo($thumbnail['name'], PATHINFO_EXTENSION);

    if (!in_array($extension, $allowed_extensions)) {
        $_SESSION['add-post'] = "File should be png, jpg, or jpeg";
        header('Location: ' . ROOT_URL . 'admin/add-post.php');
        exit();
    }

    // Check if the uploaded file is within size limits (2MB)
    if ($thumbnail['size'] > 2 * 1024 * 1024) {
        $_SESSION['add-post'] = "File size too big. Should be less than 2MB";
        header('Location: ' . ROOT_URL . 'admin/add-post.php');
        exit();
    }

    // Generate a unique filename for the thumbnail
    $time = time();
    $thumbnail_name = $time . '_' . $thumbnail['name'];
    $thumbnail_destination_path = '../images/' . $thumbnail_name;

    // Move the uploaded file to the destination path
    if (move_uploaded_file($thumbnail['tmp_name'], $thumbnail_destination_path)) {
        // If the new post is featured, update existing featured posts to set is_featured to 0
        if ($is_featured === 1) {
            $update_query = "UPDATE posts SET is_featured = 0 WHERE is_featured = 1";
            $update_result = mysqli_query($connection, $update_query);
        }

        // Use prepared statements to insert data into the database
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssiii", $title, $body, $thumbnail_name, $category_id, $author_id, $is_featured);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['add-post-success'] = "New post added successfully";
                header('Location: ' . ROOT_URL . 'admin/');
                exit();
            } else {
                $_SESSION['add-post'] = "Error inserting post into the database: " . mysqli_error($connection);
            }
        } else {
            $_SESSION['add-post'] = "Database error: " . mysqli_error($connection);
        }
    } else {
        $_SESSION['add-post'] = "Error uploading the file";
    }
}

header('Location: ' . ROOT_URL . 'admin/add-post.php');
exit();
