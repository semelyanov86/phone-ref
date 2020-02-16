## Function improvement task

My suggestion is to rewrite function to following:

```javascript
function compareStringsSE(s, a, b)
{
	if (s == '' || (a == '' && b == '')) {
		return -1;
	}
	return Math.max(s.lastIndexOf(a), s.lastIndexOf(b));  
}
```

## Practical task

Created default laravel login and registration page.
After authorisation you can choose operator to make a payment.
When you redirected to payment page you can see your balance as sum of your incoming payments to this operator substracted with outcomes.
To make a payment you have to fill phone number and amount
To create tables simply run migrations

## Used Technologies

To do this task I used following frameworks and patterns:.

- Laravel 6
- Vue.js
- Axios
- Bootstrap 4
- vue-blockui to display loading page
- vue-the-mask - to display phone input mask
- vue-toast-notification - to display notifications

## How to install
- Clone this project
- Go to the folder application using cd command on your cmd or terminal
- Run composer install on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open my .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- By default, the username is root and you can leave the password field empty.
- By default, the username is root and password is also root.
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve
- Go to localhost:8000
