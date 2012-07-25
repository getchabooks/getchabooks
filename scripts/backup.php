<?php

exec("mysqldump -u $dbUser --password=$prodDbPass $prodDbName > " . BASE_DIR . '/config/prod.sql');
exec("mysqldump -u $dbUser --password=$devDbPass $devDbName > " . BASE_DIR . '/config/dev.sql');
