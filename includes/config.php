<?php 

function console_log($output, $with_script_tags = true) {
	$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
	');';
	if ($with_script_tags) {
	$js_code = '<script>' . $js_code . '</script>';
	}
	echo $js_code;
}

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
	define('DBNAME', 'konyvajanlo');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost/szerveroldali_projekt/');

}else
{
	/** database config **/
	define('DBNAME', 'my_db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.yourwebsite.com');

}

/** true means show errors **/
define('DEBUG', true);