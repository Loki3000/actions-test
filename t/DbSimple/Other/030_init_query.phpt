--TEST--
Init query on connect
--FILE--
<?php
$dirname=__DIR__;
require_once __DIR__ . '/../init_lasy.php';

function main(&$DB)
{
	$DB->addInit('SET time_zone = ?', '+04:00');
	echo "test\n";
	print_r($DB->selectRow('SHOW VARIABLES like ?', 'time_zone'));
}

?>
--EXPECT--
test
Query: 'SET time_zone = \'+04:00\''
Query: 'SHOW VARIABLES like \'time_zone\''
Array
(
    [Variable_name] => time_zone
    [Value] => +04:00
)
