# task-se-linux-sendmail
This project replicates an issue whereby SELinux is blocking the mail() function when executed via nginx/php-fpm.
Please review the task and advise us of the correct SELinux rules to fix the problem.
### Steps to reproduce ###
Launch the vagrant project and access via http://localhost:4567/test.php
```
vagrant up
```
Enter your email address on the form and send a test email. The email should be blocked by SELinux, and not get sent. We can use the contents of the audit log with audit2allow to create an SELinux policy the permit the operation. 

Now, enter the vagrant box: 
```
vagrant ssh
```
Check the maillog `/var/log/maillog` we can see the following error:
```
Nov 26 16:49:15 localhost postfix/sendmail[3195]: fatal: open /etc/postfix/main.cf: Permission denied
```
Make SELinux permissive so we trigger all violations
```
sudo setenforce 0
```
Send another test email. This time it should work, but it will record a number of SE policy exceptions in the audit log. We can send these to audit2allow to create a policy, load the policy and then renable SELinux enforcing.
```
sudo grep postfix /var/log/audit/audit.log | audit2allow -M sendmail-main-cf
sudo semodule -i sendmail-main-cf.pp
sudo setenforce 1
```
In theory, this should now allow an email to be sent, but if you try again it won't work. Instead we see a new error in the mail log `/var/log/maillog`:
```
Nov 26 17:08:48 localhost postfix/sendmail[3458]: fatal: setrlimit: Permission denied
```
