

Craigslist X Scanner - Scan all cities for item X 
====================================================

Craigslist X Scanner is a web scraper which scans all cities for a specific item. 

How To Use
--------------

1 - Specify the cities you want to scan by modifying the CL_Cities.html file.
2 - Extract the URL from craigslist for the specific item you want scanned.
	a - Go to landing page of any city on craigslist(ex. http://toledo.craigslist.org/)
	b - Navigate to item you want scanned(ex. antiques - http://toledo.craigslist.org/ata/)
	c - Extract the path of the item(ata/ for example in b)
	d - Place it in the $url variable in the cl_start.php file.
3 - Make sure you have the curl exention enabled for php. 
4 - Enter the index url into your browser to start scanning!

ToDo
--------------
Use regular expressions instead of jQuery to filter items by date.

Implement asynchoronous HTTP get requests to improve scanning speed. 

Format and place comments in code.
