# Streaming App

## Setup

1. Create a Google API project, enable YouTube Data API, and create OAuth 2.0 credentials.
2. Copy `.env.example` to `.env` and fill in your DB and YouTube credentials.
3. Run `composer install` in the project root for Google and Symfony YAML packages.
4. Run `docker-compose up -d` to start the application.
5. Access `http://localhost:8080` in your browser.
