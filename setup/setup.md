
C:\xampp\apache\conf\extra - vhosts.conf

<VirtualHost yourpet.local:80>
	ServerAdmin root@localhost
	DocumentRoot "C:\xampp\htdocs\YourPet\public"
	ServerName yourpet.local
	ServerAlias www.yourpet.local
  
  <Directory "C:\xampp\htdocs\YourPet\public">
		Options Indexes FollowSymLinks 
		AllowOverride All
		Order allow,deny
		Allow from all
   </Directory>
   
</VirtualHost>


windows host config
127.0.0.1	yourpet.local


<!-- This worked? -->
<VirtualHost yourpet.local:80>
	ServerAdmin root@localhost
	DocumentRoot "C:\xampp\htdocs\YourPet\public"
	ServerName yourpet.local
	ServerAlias www.yourpet.local
	
	ErrorLog "logs/YourPetError.log"
    CustomLog "logs/YourPetAccess.log" common
  
  <Directory "C:\xampp\htdocs\YourPet\public">
		Options Indexes FollowSymLinks 
		AllowOverride All
		Order allow,deny
		Allow from all
   </Directory>
   
</VirtualHost>



<!-- Database Stuff -->

CREATE TABLE users (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    email varchar(150) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    user_roles VARCHAR(50) DEFAULT 'user' NOT NULL
);

CREATE TABLE email_verification (
    verification_id int PRIMARY KEY,
	FK_user_id int NOT NULL,
    token int NOT NULL,
    FOREIGN KEY (FK_user_id) REFERENCES users(user_id)
);


<!-- Possibly works -->
CREATE TABLE email_verification (
    verification_id int PRIMARY KEY,
	FK_user_id int NOT NULL,
    token int NOT NULL,
    generated_at DateTime,
    expires_at DateTime,
    FOREIGN KEY (FK_user_id) REFERENCES users(user_id)
);