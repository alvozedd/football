# Football Scout Report - Docker Setup

This document provides instructions for running the Football Scout Report application using Docker.

## Prerequisites

- Docker Desktop installed on your system
- Docker Compose (included with Docker Desktop)
- Git (to clone the repository)

## Quick Start

1. **Clone the repository:**
   ```bash
   git clone https://github.com/alvozedd/football.git
   cd football
   ```

2. **Copy Docker environment file:**
   ```bash
   # On Windows
   copy .env.docker .env
   
   # On Linux/Mac
   cp .env.docker .env
   ```

3. **Build and start the containers:**
   ```bash
   docker-compose up -d --build
   ```

4. **Wait for containers to be ready** (about 2-3 minutes for first run)

5. **Access the application:**
   - **Main Application:** http://localhost:8000
   - **phpMyAdmin:** http://localhost:8080
   - **MySQL Database:** localhost:3306

## Services Overview

### Laravel Application (Port 8000)
- **URL:** http://localhost:8000
- **Container:** football_scout_app
- **Technology:** PHP 8.2 + Apache + Laravel

### MySQL Database (Port 3306)
- **Host:** localhost:3306
- **Database:** football_scout
- **Root Password:** rootpassword
- **User:** football_user
- **Password:** football_password

### phpMyAdmin (Port 8080)
- **URL:** http://localhost:8080
- **Username:** root
- **Password:** rootpassword

### Redis Cache (Port 6379)
- **Host:** localhost:6379
- **Used for:** Session storage and caching

## Docker Commands

### Start the application:
```bash
docker-compose up -d
```

### Stop the application:
```bash
docker-compose down
```

### View logs:
```bash
# All services
docker-compose logs

# Specific service
docker-compose logs app
docker-compose logs mysql
docker-compose logs phpmyadmin
```

### Rebuild containers:
```bash
docker-compose down
docker-compose up -d --build
```

### Access container shell:
```bash
# Laravel app container
docker exec -it football_scout_app bash

# MySQL container
docker exec -it football_scout_mysql mysql -u root -p
```

## Database Management

### Run Laravel migrations:
```bash
docker exec -it football_scout_app php artisan migrate
```

### Seed the database:
```bash
docker exec -it football_scout_app php artisan db:seed
```

### Reset database:
```bash
docker exec -it football_scout_app php artisan migrate:fresh --seed
```

## Troubleshooting

### Container won't start:
1. Check if ports are already in use:
   ```bash
   netstat -an | findstr :8000
   netstat -an | findstr :3306
   netstat -an | findstr :8080
   ```

2. Stop conflicting services (like XAMPP) or change ports in docker-compose.yml

### Database connection issues:
1. Wait for MySQL to fully initialize (check logs):
   ```bash
   docker-compose logs mysql
   ```

2. Verify database credentials in .env file

### Permission issues:
```bash
docker exec -it football_scout_app chown -R www-data:www-data /var/www/html/storage
docker exec -it football_scout_app chmod -R 755 /var/www/html/storage
```

## Development Mode

For development with live code changes:

1. **Modify docker-compose.yml** to mount source code:
   ```yaml
   volumes:
     - .:/var/www/html
   ```

2. **Set debug mode** in .env:
   ```
   APP_DEBUG=true
   APP_ENV=local
   ```

## Production Deployment

For production deployment:

1. **Update environment variables** in .env:
   ```
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Use stronger passwords** for database

3. **Configure proper domain** in APP_URL

## Data Persistence

- **MySQL data** is persisted in Docker volume `mysql_data`
- **Redis data** is persisted in Docker volume `redis_data`
- **Application files** are copied into the container during build

## Backup and Restore

### Backup database:
```bash
docker exec football_scout_mysql mysqldump -u root -prootpassword football_scout > backup.sql
```

### Restore database:
```bash
docker exec -i football_scout_mysql mysql -u root -prootpassword football_scout < backup.sql
```

## Support

If you encounter any issues:
1. Check the logs: `docker-compose logs`
2. Ensure all containers are running: `docker-compose ps`
3. Verify port availability
4. Check Docker Desktop is running properly
