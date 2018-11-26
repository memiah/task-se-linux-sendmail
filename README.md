# task-se-linux-sendmail
This project replicates an issue whereby SELinux is blocking the mail() function when executed via nginx/php-fpm.
Please review the task and advise us of the correct SELinux rules to fix the problem.
### Steps to reproduce ###
Launch the vagrant project and access via http://localhost:4567/test.php
```
vagrant up
```
Enter your email address on the form and send a test email. The email should be blocked by SELinux, and not get sent.

### Error logs ###
You can view the errors on the server
```
vagrant ssh
```
Inside `/var/log/maillog` we can see the following error:
```
Nov 26 16:49:15 localhost postfix/sendmail[3195]: fatal: open /etc/postfix/main.cf: Permission denied
```
