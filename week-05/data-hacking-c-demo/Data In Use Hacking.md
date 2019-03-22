# Data In User Hacking

## How to use

``` bash
# Modify the string variable in loop.c
gcc -I/usr/include/x86_64-linux-gnu/ download.c -o download -L/usr/local/lib -lcurl
./download

ps -aux | grep 'download'
# take note of the process-id

# python3 read_write_heap.py [process id] [original string] [string to change to]
python3 read_write_heap.py 4618 http://shopedia.com/demo/hackwagon.png http://hacker.io/demo/cow123455678.png
```

Observe the hackwagon.png in the local directory.

Reference: https://github.com/holbertonschool/Hack-The-Virtual-Memory/tree/master/00.%20C%20strings%20%26%20the%20proc%20filesystem 