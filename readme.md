# Excel laravel

Example use phpExcel and  maatwebsite excel
by Simon


Guide config:


Step 1: Add "phpoffice/phpexcel": "dev-master" to your composer.json.


Step 2: execute "composer update" on terminal.

Wait a few minutes.



Step 3:- Open the file "/vendor/composer/autoload_namespaces.php". Paste the below line in the file.
'PHPExcel' => array($vendorDir . '/phpoffice/phpexcel/Classes'),



Step 4:- Now you can use PHPEXCEL library in your controllers or middleware or library.

use PHPExcel; 
use PHPExcel_Cell;
use PHPExcel_IOFactory;