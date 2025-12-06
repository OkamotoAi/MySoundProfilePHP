# MySoundProfile (Modern)

A Spotify music analysis application built with **Laravel 11**, **React**, **Inertia.js**, and **Tailwind CSS**.

## Prerequisites
Ensure you have the following installed:
- **PHP** >= 8.2
- **Composer**
- **Node.js** & **npm**
- **MySQL** (or MariaDB)

## Setup Instructions

### 1. Install Dependencies
Open a terminal in the project directory (`MySoundProfileLaravel`) and run:

```bash
composer install
npm install
```

### 2. Configure Environment
1. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
2. Open `.env` and configure your Database and Spotify credentials:

   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=spotify
   DB_USERNAME=root
   DB_PASSWORD=password

   SPOTIFY_CLIENT_ID='your_client_id_here'
   SPOTIFY_CLIENT_SECRET='your_client_secret_here'
   REDIRECT_URI='http://127.0.0.1:8000/callback'
   ```

### 3. Database Setup
Ensure your MySQL server is running and the `spotify` database exists. Then run migrations:

```bash
php artisan migrate
```

### 4. Build Frontend
Build the React/Tailwind assets:

```bash
npm run build
```

## Running the Application

1. **Start the Development Server**:
   ```bash
   php artisan serve
   ```
   The app will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000).

2. **Register & Login**:
   - Go to `http://127.0.0.1:8000/register` to create a local account.

3. **Sync with Spotify**:
   - On the Dashboard, click **"Sync with Spotify"**.
   - **Note**: As of Nov 2024, the "Audio Features" API is deprecated. This app will only retrieve track metadata (Name, Artist, Popularity).

## Important Configuration Note
- **Redirect URI**: Must effectively be `http://127.0.0.1:8000/callback`. 
- Make sure this URI is registered exactly in your [Spotify Developer Dashboard](https://developer.spotify.com/dashboard/).
