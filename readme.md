# Info and guide

This is a simple project designed to communicate via a sql database in order to alter the data of an hypothetical company consisting of multiple departments. It is designed to be:

- [x] Simple
- [x] Functional
- [x] Safe, using a simple custom token system

The site also supports connection options as login, logout, account creation and deletion. It is built mostly for a representation of the functionality that php offers when combined with javascript and html.

## How to download and use

1. First clone the repo.
2. If you haven't already, download php server in order to be able to host ithe server. I used version 9.1 but most versions should work properly.
3. Download mysql and create a user account that can create, alter and delete.
4. Copy and paste the database.txt inside the mysql promt. You may change the name of the database.
5. Now go to the connect.php in the scripts folder and in the connection options use your mysql name and password in order to be able to connect to the database. Change the database name to the one you set if you changed it in the previous step.
6. You should be able to start up the server, create an account and start using the database.

### Additional info
- The site uses no external photos or media, making it quite light and fast
- As additional security measures most special characters cannot be used inside the prompts of the site. All input is sanitized and in order for most php transactions to work the source site must be the expected one, if not the transaction never happens. It is an additional security measure.
- The UI could be greatly improved upon but i chose it to be quite simple. That way the debuggging was easier.
- Tokens, IP address and provider are saved inside the SiteUsers table. Also there is saved the max time a token is valid in order to not allow infinite log in times. The current token duration is one day. You can change it in the validate_login.php inside the scripts folder.
- If you try to access the site without being logged in you will be redirected back to the login page. Similarly, if you try to log in while you are already logged in you will be redirected to the home page automatically.