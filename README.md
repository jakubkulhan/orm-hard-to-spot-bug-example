# ORM hard-to-spot bug

## Buggy

```php
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
```

```bash
$ ./vendor/bin/doctrine orm:schema-tool:create
$ php init.php
int(1)
$ php associate.php 1
ok
$ php associate.php 1
ok
$ php associate.php 1
ok
$ php associate.php 1
ok
$ php associate.php 1
ok
$ php associate.php 1
Fatal error: Uncaught Example\Exception\MaxAssociatedUsersReachedException: Account [1] reached max associated users [5], cannot associate a new one. in .../associate.php:35
Stack trace:
#0 .../associate.php(13): Example\associateUserWithAccount(Object(Doctrine\ORM\EntityManager), Object(Example\User), Object(Example\Account))
#1 .../associate.php(58): Example\associateUserWithAccountOrLogAttempt(Object(Doctrine\ORM\EntityManager), Object(Example\User), Object(Example\Account))
#2 {main}
  thrown in .../associate.php on line 35
$ sqlite3 db.sqlite 'select count(*) from AccountUserAssociation where account_id = 1'
6
$ sqlite3 db.sqlite 'select associatedUsers from Account where id = 1'
6
```

## Almost fixed

```diff
$ git diff master...almost-fixed
@@ -29,6 +29,12 @@ function associateUserWithAccountOrLogAttempt(EntityManager $em, User $user, Acc
 
 function associateUserWithAccount(EntityManager $em, User $user, Account $account)
 {
+       $account->setAssociatedUsers($account->getAssociatedUsers() + 1);
+
+       if ($account->getAssociatedUsers() > $account->getPlan()->getMaxAssociatedUsers()) {
+               throw new MaxAssociatedUsersReachedException($account->getId(), $account->getPlan()->getMaxAssociatedUsers());
+       }
+
        $association = new AccountUserAssociation();
        $association
                ->setAccount($account)
@@ -37,12 +43,6 @@ function associateUserWithAccount(EntityManager $em, User $user, Account $accoun
 
        $em->persist($association);
 
-       $account->setAssociatedUsers($account->getAssociatedUsers() + 1);
-
-       if ($account->getAssociatedUsers() > $account->getPlan()->getMaxAssociatedUsers()) {
-               throw new MaxAssociatedUsersReachedException($account->getId(), $account->getPlan()->getMaxAssociatedUsers());
-       }
-
        $em->flush();
 }
 

```

## Fixed

```diff
$ git diff almost-fixed...fixed
@@ -29,9 +29,9 @@ function associateUserWithAccountOrLogAttempt(EntityManager $em, User $user, Acc
 
 function associateUserWithAccount(EntityManager $em, User $user, Account $account)
 {
-       $account->setAssociatedUsers($account->getAssociatedUsers() + 1);
+       $newAssociatedUsers = $account->getAssociatedUsers() + 1;
 
-       if ($account->getAssociatedUsers() > $account->getPlan()->getMaxAssociatedUsers()) {
+       if ($newAssociatedUsers > $account->getPlan()->getMaxAssociatedUsers()) {
                throw new MaxAssociatedUsersReachedException($account->getId(), $account->getPlan()->getMaxAssociatedUsers());
        }
 
@@ -43,6 +43,8 @@ function associateUserWithAccount(EntityManager $em, User $user, Account $accoun
 
        $em->persist($association);
 
+       $account->setAssociatedUsers($newAssociatedUsers);
+
        $em->flush();
 }
```
