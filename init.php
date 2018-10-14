<?php
namespace Example;

use Doctrine\ORM\EntityManager;

/** @var EntityManager $em */
$em = require_once __DIR__ . "/bootstrap.php";

$plan = new AccountPlan();
$plan
	->setName("Basic")
	->setMaxAssociatedUsers(5);

$em->persist($plan);

$account = new Account();
$account
	->setName("My account")
	->setAssociatedUsers(0)
	->setPlan($plan);

$em->persist($account);

$em->flush();

var_dump($account->getId());
