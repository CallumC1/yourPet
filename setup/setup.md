
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