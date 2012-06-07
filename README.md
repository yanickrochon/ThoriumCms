SpeckCms
========
Version 0.0.1 created by Yanick Rochon

Introduction
------------
SpeckCMS is a module to manage static or dynamic pages.

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)
* [ZfcBase](https://github.com/ZF-Commons/ZfcBase) (latest master).
* [ZfcUser](https://github.com/ZF-Commons/ZfcUser) (latest master).

Features / Goals
----------------

* enable insertion of view helpers and widgets through markup (to be defined)

Installation
------------

### Main Setup

1. Install the [ZfcBase](https://github.com/ZF-Commons/ZfcBase) and the
   [ZfcUser](https://github.com/ZF-Commons/ZfcUser) ZF2 modules by cloning
   them into `./vendor/` and enabling them in your `application.config.php` 
   file.
2. Clone this project into your `./vendor/` directory and enable it in your
   `application.config.php` file.
3. Import the SQL schema located in `./vendor/SpeckCms/data/schema.sql`.

### Post-Install: Zend\Db

1. If you do not already have a valid Zend\Db\Adapter\Adapter in your service
   manager configuration, put the following in `./config/autoload/database.local.php`:

        <?php

        $dbParams = array(
            'database'  => 'changeme',
            'username'  => 'changeme',
            'password'  => 'changeme',
            'hostname'  => 'changeme',
        );

        return array(
            'service_manager' => array(
                'factories' => array(
                    'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                        return new Zend\Db\Adapter\Adapter(array(
                            'driver'    => 'pdo',
                            'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                            'database'  => $dbParams['database'],
                            'username'  => $dbParams['username'],
                            'password'  => $dbParams['password'],
                            'hostname'  => $dbParams['hostname'],
                        ));
                    },
                ),
            ),
        );


