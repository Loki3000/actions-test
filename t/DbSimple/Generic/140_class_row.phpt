--TEST--
Generic: row class
--FILE--
<?php
$dirname=__DIR__;
require_once __DIR__ . '/../init.php';

class r
{
    private $r;

    public function __construct($row)
    {
        $this->r = $row;
    }
    
    public function __get($name)
    {
        return $this->r[$name];
    }
    
}

function main(&$DB)
{
    @$DB->query("DROP TABLE test");
    $DB->query("CREATE TABLE test(id INTEGER, str VARCHAR(1), str2 VARCHAR(1))");
    $DB->query("INSERT INTO test(id, str, str2) VALUES( 1, 'a', 'b')");
    $DB->query("INSERT INTO test(id, str, str2) VALUES( 2, 'c', 'd')");
    $res = $DB->setClassName('r')->select('SELECT * FROM test');
    foreach($res as $r) {
        echo $r->str.' '.$r->str2."\n";
    }
    $res = $DB->select('SELECT str FROM test');
    print_r($res);
    $res = $DB->setClassName('r')->selectRow('SELECT * FROM test');
    echo $res->str.' '.$res->str2."\n";
}

?>
--EXPECT--
Query: 'DROP TABLE test'
Query: 'CREATE TABLE test(id INTEGER, str VARCHAR(1), str2 VARCHAR(1))'
Query: 'INSERT INTO test(id, str, str2) VALUES( 1, \'a\', \'b\')'
Query: 'INSERT INTO test(id, str, str2) VALUES( 2, \'c\', \'d\')'
Query: 'SELECT * FROM test'
a b
c d
Query: 'SELECT str FROM test'
Array
(
    [0] => Array
        (
            [str] => a
        )

    [1] => Array
        (
            [str] => c
        )

)
Query: 'SELECT * FROM test'
a b
