# BlogWlog (BlogMania) – A Simple Blog Management System

BlogMania (shown as **BLOGMANIA** in the site header) is a basic PHP + MySQL blog management system. Visitors can browse, read and search blog posts; registered users can sign in to a dashboard to write and manage their own posts; admins can additionally manage users and categories.

Before Login:
![image](https://github.com/utkarshpayal/BlogWlog/assets/104209135/fd43aec7-a6b1-40b6-a652-268b3538f38e)

After Login:
![image](https://github.com/utkarshpayal/BlogWlog/assets/104209135/7849e322-d07a-4652-bc8d-d908f4967dcf)

Live demo: https://blogwlog.000webhostapp.com/ (needs confirmation – the hosting may no longer be available)

## Table of Contents

1. [Features](#features)
2. [Tech Stack](#tech-stack)
3. [Project Structure](#project-structure)
4. [Installation](#installation)
5. [Configuration](#configuration)
6. [Usage](#usage)
7. [Contributing](#contributing)

## Features

- **Public blog**
  - Home page with a featured post and the latest posts
  - Blog listing page, individual post pages and posts filtered by category
  - Search posts by title
  - Static About, Services and Contact pages
- **User accounts**
  - Sign up with first name, last name, username, email, password (minimum 8 characters) and an avatar image
  - Passwords are hashed with PHP's `password_hash` and checked with `password_verify`
  - Sign in / log out using PHP sessions
- **Dashboard (signed-in users)**
  - Add posts with a title, body, category and thumbnail image
  - View, edit and delete your own posts
- **Admin-only features** (users flagged as admin)
  - Mark posts as featured
  - Add, edit, delete and list users
  - Add, edit, delete and list categories

## Tech Stack

- PHP (procedural, `mysqli`)
- MySQL
- HTML, CSS, JavaScript
- [Unicons](https://iconscout.com/unicons) and Google Fonts (Montserrat) loaded from CDNs

## Project Structure

- **/admin**: Dashboard for managing posts, categories and users (`add-*`, `edit-*`, `delete-*`, `manage-*` pages and their `*-logic.php` handlers).
- **/admin/config**: Constants and database connection used by the admin pages.
- **/admin/partials**: Shared header for the admin pages (redirects to sign-in when not logged in).
- **/config**: Constants (`constants.php`) and database connection (`database.php`) for the public site.
- **/css**: Site stylesheet.
- **/images**: Uploaded post thumbnails and user avatars.
- **/js**: Client-side JavaScript (`main.js`).
- **/partials**: Shared header and footer for the public pages.
- Root PHP files: public pages (`index.php`, `blog.php`, `post.php`, `category-posts.php`, `search.php`, `about.php`, `services.php`, `contact.php`) and authentication (`signup.php`, `signin.php`, their `*-logic.php` handlers, and `logout.php`).

## Installation

1. Install a PHP + MySQL stack (for example XAMPP, WAMP or LAMP).
2. Clone the repository into your web server's document root:

   ```bash
   git clone https://github.com/utkarshpayal/BlogWlog.git
   ```

3. Create a MySQL database for the blog. The repository does not include a SQL schema/dump, so the tables must be created manually (needs confirmation for exact column types). Based on the queries in the code, the app uses:
   - `users`: `id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `isadmin`
   - `categories`: `id`, `title`, `discription`
   - `posts`: `id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `is_featured`
4. Update the configuration (see below).
5. Open the site in your browser at the URL you configured as `ROOT_URL`.

## Configuration

There are no environment variables. Settings are PHP constants defined in **two** files, which should be kept in sync:

- `config/constants.php`
- `admin/config/constants.php`

| Constant   | Purpose                                                            |
| ---------- | ------------------------------------------------------------------ |
| `ROOT_URL` | Base URL of the site (used to build links and redirects); must end with `/` |
| `DB_HOST`  | MySQL host                                                         |
| `DB_USER`  | MySQL user                                                         |
| `DB_PASS`  | MySQL password                                                     |
| `DB_NAME`  | MySQL database name                                                |

Set these to match your own environment. Do not commit real credentials.

## Usage

- **Visitors** can browse the home page, the Blog page, individual posts and category pages, and use the search box to find posts by title.
- **Sign up** to create an account, then **Sign in**; a **Dashboard** link appears in the navigation.
- From the dashboard, signed-in users can add posts and manage their own posts.
- Admin users additionally see **Add User**, **Manage Users**, **Add Category** and **Manage Categories**, and can mark posts as featured. Admins can choose a user role when adding a user from the dashboard. Since public sign-up creates regular users, the first admin must be created by setting `isadmin` for that user directly in the `users` table.

## Contributing

Contributions to improve and extend the project are welcome:

1. Fork the repository on GitHub.
2. Create a new branch with a descriptive name for your feature or bug fix.
3. Make your changes and commit them with clear commit messages.
4. Open a pull request.
