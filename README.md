Before Login:
![image](https://github.com/utkarshpayal/BlogWlog/assets/104209135/fd43aec7-a6b1-40b6-a652-268b3538f38e)

After Login:
![image](https://github.com/utkarshpayal/BlogWlog/assets/104209135/7849e322-d07a-4652-bc8d-d908f4967dcf)

# BlogMenia - A Simple Blog Management System

BlogMenia is a basic blog management system that allows users to create, edit, and manage blog posts, categories, and users. It is designed to provide a simple and easy-to-use platform for bloggers to share their thoughts and ideas.

## Table of Contents

1. [Project Structure](#project-structure)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Features](#features)
5. [Contributing](#contributing)
6. [License](#license)

## Project Structure

BlogMenia project is organized as follows:

- **/admin**: This directory contains the admin panel for managing categories, posts, and users.
- **/config**: Configuration files for the BlogMenia system.
- **/css**: Stylesheets used to define the blog's appearance.
- **/images**: Images and media files used in blog posts.
- **/js**: JavaScript files for any client-side functionality.
- **/partials**: Reusable HTML templates or partials used in different parts of the website.
- PHP files (e.g., `about.php`, `blog.php`, `contact.php`, etc.) represent different pages of the blog.
- **/admin/config**: Configuration files for the admin panel.
- **/admin/partials**: Reusable HTML templates for the admin panel.
- PHP files in the `/admin` directory provide functionality for managing categories, posts, and users.

## Installation

To install and run BlogMenia on your local server, follow these steps:

1. Clone the BlogMenia repository to your server's web root directory.

2. Configure your web server to serve the BlogMenia directory as the web root.

3. Ensure you have a working MySQL database. You may need to update the database configuration in the project's config files.

4. Open your web browser and access the project by navigating to the appropriate URL.

## Usage

BlogMenia is a simple blog management system designed for both bloggers and administrators. Users can perform the following actions:

- **Blogging**:
  - View the list of blog posts on the homepage.
  - Read individual blog posts by clicking on their titles.
  - Use the search functionality to find specific posts.

- **Admin Panel**:
  - Log in to the admin panel with appropriate credentials.
  - Manage blog categories (e.g., add, edit, delete categories).
  - Create and edit blog posts.
  - Manage registered users (add, edit, delete users).

## Features

- **User Authentication**: BlogMenia provides user authentication, ensuring that only authorized administrators can access the admin panel.

- **Category Management**: Admins can categorize blog posts into different categories for easy organization and navigation.

- **Blog Post Management**: Admins can create, edit, and delete blog posts, including the ability to add images and media to their posts.

- **User Management**: Administrators can manage registered users, including adding new users, editing user profiles, and removing users as needed.

## Contributing

We welcome contributions to improve and extend BlogMenia. If you'd like to contribute, please follow these steps:

1. Fork the repository on GitHub.
2. Create a new branch with a descriptive name for your feature or bug fix.
3. Make your changes and commit them with clear commit messages.

