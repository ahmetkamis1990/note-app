Clone the repository

    git clone git@github.com:ahmetkamis1990/note-app.git

Switch to the repo folder

    cd note-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes(db credentials) in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


You can find postman collection at /notes-collection.postman_collection.json which includes API calls.You should call login function to get a token which is required for other API functions
