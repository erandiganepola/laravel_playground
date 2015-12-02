===================================================================================================================

Important facts to consider when building

==================================================================================================================


1.  Each model should have protected fields(as in User model)specifying the table, primary key and whether it is
    incrementing in the table.
    
2.  run a composer update when pulling from heroku.

3.  Once pulled, run "php artisan migrate" to create the database tables. Make sure a database in the name 'sms' is created
    in the localhost

    