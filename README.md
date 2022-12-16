# Book-api-laravel
> Book data management/collection api

## Routes

### Authentication
<pre>/api/login          -<b>POST</b>-</pre>
<pre>/api/register       -<b>POST</b>-</pre>
<pre>/api/logout         -<b>POST</b>-</pre>
<br>

### Books
<pre>/api/book           -<b>GET</b>-</pre>
<pre>/api/book/{id}      -<b>GET</b>-</pre>
<pre>/api/book           -<b>POST</b>-</pre>
<pre>/api/book/{id}      -<b>PUT</b>-</pre>
<pre>/api/book/{id}      -<b>DELETE</b>-</pre>
<br>

### Authors
<pre>/api/authors        -<b>GET</b>-</pre>
<pre>/api/authors/{id}   -<b>GET</b>-</pre>
<pre>/api/authors        -<b>POST</b>-</pre>
<pre>/api/authors/{id}   -<b>PUT</b>-</pre>
<pre>/api/authors/{id}   -<b>DELETE</b>-</pre>
<br>

### Genres
<pre>/api/genres         -<b>GET</b>-</pre>
<pre>/api/genres/{id}    -<b>GET</b>-</pre>
<pre>/api/genres         -<b>POST</b>-</pre>
<pre>/api/genres/{id}    -<b>PUT</b>-</pre>
<pre>/api/genres/{id}    -<b>DELETE</b>-</pre>
<br>

### Users
<pre>/api/users          -<b>GET</b>-</pre>
<pre>/api/users/{id}     -<b>GET</b>-</pre>
<pre>/api/users          -<b>POST</b>-</pre>
<pre>/api/users/{id}     -<b>PUT</b>-</pre>
<pre>/api/users/{id}     -<b>DELETE</b>-</pre>



## Setup
```bash
# - Before start make sure to have php, composer and mysql 
# - Create a database
# - Remove that part ".example" from ".env.example" file
# - And fill database fields in the .env file

$ git clone https://github.com/cnryzgn/Book-api-laravel.git

$ cd Book-api-laravel

$ composer install

$ php artisan migrate

$ php artisan serve

 ```
