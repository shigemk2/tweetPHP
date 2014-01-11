<?php
require_once("twitteroauth/twitteroauth/twitteroauth.php");
require_once("config.php");
$connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_TOKEN,ACCESS_TOKEN_SECRET);
$tweets = $connection->get('search/tweets', array('q' => 'a'));

$filename = './hoge.json';
if (!file_exists($filename)) {
  touch($filename);
 } else {
  echo ('すでにファイルが存在しています。file name:' . $filename);
 }

if (!file_exists($filename) && !is_writable($filename)
    || !is_writable(dirname($filename))) {
  echo "書き込みできないか、ファイルがありません。",PHP_EOL;
  exit(-1);
 }

$fp = fopen($filename,'a') or dir('ファイルを開けません');

fwrite($fp, sprintf(json_encode($tweets)));

fclose($fp);