Steps to setup project:
1. Goto project directory in terminal/command prompt and run command "composer install"(Install composer if not already installed)
2. Create a new database with name "blog_krunal"
3. Run command "php artisan migrate". It will create all the tables for database "blog_krunal"
4. Run command "php artisan db:seed". It will create default admin with userid "admin@admin.com" and password "123456".
5. Go to any browser and enter URL "http://localhost/blog_krunal/public"
