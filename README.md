postfixadmin0
=============

Goals
-----

* Beauty
    * use twitter bootstrap as base layout / markup
* Simplify
    * remove support for postgres
    * remove support for deprecated php-mysql (use mysqli instead)
    * simplify config file (best case = only mysql config needed)
* Modernize PHP
    * don't mix-in perl style (even though supported/aliased)
    * support pagination
    * use some better type of l10n
    * strict utc timestamps (+ convert them on template side via config)
* Modernize MySQL
    * switch to InnoDB
    * simplify tables, remove unused tables
    * always use AI primary key
    * remove unused columns (maildir?)
    * use utf8_general_ci as collate
    * simplify sql queries

Future
------
* write some nice and easy tutorial
* make it pluggable, let 3rd party add features (maybe some spam/stats integration?)


What is NOT going to happen
---------------------------

* Usage of PHP-Framework (would bloat unnecessary)
* Usage of Template Engine (PHP IS already a template engine, no need to put one in between, I will use an abstraction layer though)
* Support of admin tools that don't make sense in PHP (like Backup/Fetchmail)
* Remove support for sendmail (there are better tools for that...)