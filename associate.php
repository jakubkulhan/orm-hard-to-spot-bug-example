<?php
namespace Example;

use Doctrine\ORM\EntityManager;
use Example\Exception\MaxAssociatedUsersReachedException;

/** @var EntityManager $em */
$em = require_once __DIR__ . "/bootstrap.php";

function associateUserWithAccountOrLogAttempt(EntityManager $em, User $user, Account $account)
{
	try {
		associateUserWithAccount($em, $user, $account);
	} catch (MaxAssociatedUsersReachedException $e) {
		$attempt = new AccountUserAssociationAttempt();
		$attempt
			->setAccount($account)
			->setUser($user)
			->setPlan($account->getPlan())
			->setMaxAssociatedUsers($e->getMaxAssociatedUsers())
			->setCreatedAt(new \DateTime());

		$em->persist($attempt);
		$em->flush();

		throw $e;
	}
}

function associateUserWithAccount(EntityManager $em, User $user, Account $account)
{
	$association = new AccountUserAssociation();
	$association
		->setAccount($account)
		->setUser($user)
		->setCreatedAt(new \DateTime());

	$em->persist($association);

	$account->setAssociatedUsers($account->getAssociatedUsers() + 1);

	if ($account->getAssociatedUsers() > $account->getPlan()->getMaxAssociatedUsers()) {
		throw new MaxAssociatedUsersReachedException($account->getId(), $account->getPlan()->getMaxAssociatedUsers());
	}

	$em->flush();
}

$user = new User();
$user
	->setName("User #" . microtime(true));

$em->persist($user);
$em->flush();

$account = $em->find(Account::class, intval($argv[1]));

associateUserWithAccountOrLogAttempt($em, $user, $account);

echo "ok\n";
