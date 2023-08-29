
## Project Name

Form Builder

## Description

Form Builder is a web application that allows users to create customizable forms with drag-and-drop functionality. It provides features such as form creation, submission tracking, and data export.

## Dependencies

1. Clone the repository 

   ```
   git clone https://github.com/baraaha/form-app-backend.git
   ```

2. Navigate to the backend directory:

   ```
   cd form-app-backend

   ```

3. Install the dependencies:

   ```
   composer install
   ```

4. Configure environment variables:

   - Create a `.env` file in the root directory of the backend project.
   - Set the necessary environment variables, such as database credentials and API-related configurations.

5. Generate an application key:

   ```
   php artisan key:generate
   ```

6. Run database migrations:

   ```
   php artisan migrate
   ```

7. Start the Laravel development server:

   ```
   php artisan serve
   ```

## Additional Configurations

- Database Configuration:
  - Create a new MySQL database.
  - Update the `.env` file with the database credentials:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

## Contributing

- Fork the repository.
- Create a new branch.
- Make your changes and commit them.
- Push your changes to your forked repository.
- Submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

For any questions or inquiries, please contact [Ahmed Hmed] at [ahmed7med89@gmail.com].
