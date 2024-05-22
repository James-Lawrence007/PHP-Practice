<?php

$title = 'PHP is awesome!';

require 'views/index.view.php';

if (isset($_POST['email'])) {
	var_dump($_POST);
}