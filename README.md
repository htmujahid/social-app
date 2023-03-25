# Social App

A social application that allows users to connect with each other, share content, and stay up-to-date with their friends and interests.

## Installation 

To install and set up the Social App on your local machine, follow these steps:

Clone the repository from GitHub:

```bash
git clone https://github.com/your-username/social-app.git
```
Install PHP dependencies via Composer:
```bash
cd social-app
composer install
```
Install JavaScript dependencies via npm:
```bash
npm install
```
Copy the .env.example file to .env and update the database connection settings to match your environment:
```bash
cp .env.example .env
```
Generate an application key:
```bash
php artisan key:generate
```
Compile the frontend assets:
```bash
npm run dev
```
Here are the default admin email and password that will be seeded into the database, but these can be changed in the .env file.
```env
SUPER_ADMIN_EMAIL=admin@social.com
SUPER_ADMIN_PASSWORD=12345678
```
Start the development server:
```bash
php artisan serve
```
Visit http://localhost:8000 in your web browser to see the Social App in action.

## Features:

- User authentication: Users can sign up, log in, and manage their account settings.
- User profiles: Users can create and edit their profiles, add a profile picture, and display their interests and activities.
- Friends system: Users can add other users as friends and view their friends' profiles and activities.
- Newsfeed: Users can view a newsfeed of updates from their friends and the pages and groups they follow.
- Content sharing: Users can share text and photos with their friends and the public.

## Technologies used:

- Laravel: The backend of the application is built with Laravel, a PHP framework.
- Vue.js: The frontend of the application is built with Vue.js, a JavaScript framework.
- MySQL: The application uses MySQL as its database.
- Tailwind CSS: The frontend of the application is styled with Tailwind CSS, a popular utility-first CSS framework.
