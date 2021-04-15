How to configuration new user for laravel project:

Define criptography for password:

    ALTER USER 'nome_do_usuario'@"localhost" IDENTIFIED WITH mysql_native_password BY '123' 


Grant full privilegies to user:

    GRANT ALL PRIVILEGES ON nome_do_banco.* TO 'nome_do_usuario'@'localhost' 
