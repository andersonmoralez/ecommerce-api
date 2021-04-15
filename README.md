How to configuration new user for laravel project:

1. ALTER USER 'nome_do_usuario'@"localhost" IDENTIFIED WITH mysql_native_password BY '123'

2. GRANT ALL PRIVILEGES ON nome_do_banco.* TO 'nome_do_usuario'@'localhost';
