# ORM hard-to-spot bug

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
PHP Fatal error:  Uncaught Example\Exception\MaxAssociatedUsersReachedException: Account [1] reached max associated users [5], cannot associate a new one. in .../associate.php:35
Stack trace:
#0 .../associate.php(13): Example\associateUserWithAccount(Object(Doctrine\ORM\EntityManager), Object(Example\User), Object(Example\Account))
#1 .../associate.php(58): Example\associateUserWithAccountOrLogAttempt(Object(Doctrine\ORM\EntityManager), Object(Example\User), Object(Example\Account))
#2 {main}
  thrown in .../associate.php on line 35

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
