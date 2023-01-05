# trimLink :writing_hand:

![image](https://user-images.githubusercontent.com/88785156/210873049-fb22e251-b20a-4c14-9e81-24c1dddad72c.png)
<p> This webpage is a simple URL shortener that allows the client to input a long link to receive a trimmed link to share with others. The trimmed link will redirect to the original link when clicked. </p>

### Prerequisites to run this project on your brower:
- A web server with PHP and MySQL installed. To install PHP: https://www.php.net/downloads.php
- An empty MySQL database named "urls" with the appropriate permissions

### Use the prerequisites:
- Clone/download this repo
- Place the downloaded files in your web server
- Set up the appropriate tables with trim_link, long_link, clicks, action columns
- Open config.php and update the MySQL database configuration with the correct hostname (localhost), username, password (empty), and database name

Then proceed to use trimLink! Edit or delete shortened URLs by clicking the corresponding buttons in the URL list
