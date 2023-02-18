# <p align="center">Corak Blog</p>

<p align="center"><img src="./public/images/project-thumbnail.jpg?raw=true" width="100%"></p>

## Corak Blog

Corak Blog - Laravel News, Magazines, Articles & Blog CMS Script, Light & Dark theme 100% responsive for all devices.

#### Top features:
- Admin Dashborad
- Featured Post
- Posts Search
- Comments System
- Latest Posts
- Profile Picture

If you are looking for more features you can see [Corak Blog Plus](https://cblog.corakdev.com/docs). It's a premium version of Corak Blog.

## Server Requirements

- PHP >= 8.1
- MySQL >= 5.7.7
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- Filter PHP Extension
- Hash PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Session PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- PHP GD Extension

## Install Corak Blog

Video tutorial: [https://www.youtube.com/watch?v=61JbinzYX8c](https://www.youtube.com/watch?v=61JbinzYX8c)

Make `.env` file from `.env-example` file.

Create a new database then config your database connection in `.env` file.

Run `composer install` command then run `npm install` command to install vendor & node modules, then run `npm run build` command to building css & js files. If you didn't have composer & npm installed on your device you can skip this step by download [vendor_and_node_modules.zip](https://corakdev.com/files/vendor_and_node_modules.zip) file and extract it into script main folder.

Run command below to create database structure.

``` bash
php artisan migrate --seed
```

Run command below to generate app key.

``` bash
php artisan key:generate
```

Run command below to create a symlink for storage files.

``` bash
php artisan storage:link
```

Run command below to start the server.

``` bash
php artisan serve
```

Admin login
- Email: admin@example.com
- Password: admin

Now you are ready to go

## Support

If you encounter an issue or have a question, feel free to send us an email to [contact@corakdev.com](mailto:contact@corakdev.com).

## License

The Corak Blog is open-sourced licensed under the [MIT license](https://opensource.org/licenses/MIT).
