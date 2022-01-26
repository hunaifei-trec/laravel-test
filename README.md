# laravel-test
laravel-test

DB Name	demo

DB SQL	Project ——> demo.sql

Apache Config

	<VirtualHost *:80> 
	    DocumentRoot "D:/laragon/www/demo/public"
	    ServerName demo.com
	    ServerAlias *.demo.com
	    <Directory "D:/laragon/www/demo/public">
	        AllowOverride All
	        Require all granted
	    </Directory>
		
		Alias /images D:/laragon/www/demo/storage/app/images
		<Directory D:/laragon/www/demo/storage/app/images> 
			Options FollowSymLinks
			allow from all
		</Directory>
	</VirtualHost>
