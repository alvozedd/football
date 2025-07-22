# Football Scout Report

A Laravel web application that connects talented football players with professional coaches through data-driven scouting.

## Features

### For Players
- Create detailed player profiles with position, location, and bio
- Upload YouTube highlight videos with descriptions
- View feedback from coaches
- Manage video library

### For Coaches
- Browse and search player profiles
- Filter players by position
- Watch player highlight videos
- Leave constructive feedback for players

### For Admins
- User management and moderation
- Content oversight and deletion capabilities
- System statistics and monitoring

## Technology Stack

- **Framework**: Laravel 11
- **Authentication**: Laravel Breeze
- **Database**: MySQL
- **Frontend**: Blade templates with Tailwind CSS
- **Video Integration**: YouTube embeds

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=football_scout
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Run migrations and seed data:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

## Sample Users

After seeding, you can log in with these accounts:

- **Admin**: admin@football.com / password
- **Coach**: coach1@football.com / password
- **Player**: alex@football.com / password

## Database Schema

- **users**: User accounts with roles (player, coach, admin)
- **player_profiles**: Player information and bio
- **videos**: YouTube video links with descriptions
- **feedback**: Coach feedback for players

## Usage

1. Register as a Player, Coach, or Admin
2. **Players**: Create your profile and add video highlights
3. **Coaches**: Browse players and leave feedback
4. **Admins**: Moderate content and manage users

## Project Purpose

This is a school project demonstrating:
- Laravel MVC architecture
- Role-based authentication
- CRUD operations
- Database relationships
- File upload alternatives (YouTube links)
- Simple, clean UI design

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
