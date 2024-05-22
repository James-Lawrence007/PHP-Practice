<?php


require "SavingAccount.php";

$account = new SavingAccount(1000, 0.05);
$account->deposit(100);
// set interest rate
$account->setInterestRate(0.05);
$account->addInterest();
echo $account->getBalance();