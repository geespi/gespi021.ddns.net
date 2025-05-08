<?php

$doc = new DOMDocument();

$html = $doc->createElement('html');
$doc->appendChild($html);

$head = $doc->createElement('head');
$html->appendChild($head);

$title = $doc->createElement('title');
$head->appendChild($title);

$link = $doc->createElement('link');
$link->setAttribute('rel', 'stylesheet');
$link->setAttribute('href', './gespi021.css');
$head->appendChild($link);

$body = $doc->createElement('body');
$html->appendChild($body);

$main = $doc->createElement('main');
$body->appendChild($main);

$h1 = $doc->createElement('h1');
$h1->nodeValue = "Team #1";
$main->appendChild($h1);


$user = 'gespi021';
$password = '3589714';
$database = 'a4_gespi021';
$host = '127.0.0.1';

try {
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);

    $query = "SELECT * FROM users WHERE dob like '{$GET['month']}%'";

    foreach ($db->query($query) as $arr) {
        // loop = new row
        $div = $doc->createElement('div');
        $main->appendChild($div);

        if ($GET['month'] == $arr[5]) {
            $div->setAttribute('style', 'background:lightblue');
        }

        for ($x = 0; $x < 11; $x++) {
            $span = $doc->createElement('span');
            $span->nodeValue = $arr[$x];
            $div->appendChild($span);
        }
    }

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}

echo $doc->saveHTML();
