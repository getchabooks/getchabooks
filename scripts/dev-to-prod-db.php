<?php

require_once 'backup.php';

exec("mysql -u $dbUser --password=$prodDbPass $prodDbName < " . BASE_DIR . '/config/dev.sql');

require_once 'json.php';
