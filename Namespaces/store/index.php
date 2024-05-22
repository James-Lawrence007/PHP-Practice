<?php



require 'src/Model/Customer.php';
use store\Model\Customer;

$customer = new Customer('Bob');
echo $customer->getName();