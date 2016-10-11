<?php

require(dirname(__FILE__) . "/bootstrap.php");
require(dirname(__FILE__) . "/MiniBlogApplication.php");

//インスタンス化
$app = new MiniBlogApplication(true);

$app -> run();
