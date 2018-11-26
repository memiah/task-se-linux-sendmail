# task-se-linux-sendmail
This project replicates an issue whereby SELinux is blocking the mail() function when executed via nginx/php-fpm.
Please review the task and advise us of the correct SELinux rules to fix the problem.
### Steps to reproduce ###
Launch the vagrant project and access via http://localhost:4567/test.php

```vagrant up```
