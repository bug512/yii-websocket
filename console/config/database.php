<?php

// This is the database connection configuration.

return array(
    'connectionString' => 'pgsql:host=app_db;dbname=dbname',
    'emulatePrepare' => true,
    'username' => 'dbuser',
    'password' => 'dbpwd',
    'charset' => 'utf8',
    'tablePrefix' => 'tbl_',
);