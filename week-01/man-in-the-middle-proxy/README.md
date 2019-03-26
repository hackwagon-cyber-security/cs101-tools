# Man-in-the-middle Proxy

# Execution

1. Install mitm proxy on the attacker machine

``` bash
apt-get install python-pyasn1 python-flask python-urwid python-dev libxml2-dev libxslt-dev libffi-dev
```

2. Install the generated mitm CA certificate in the victim's machine

3. Configure proxy setting in victim's machine

4. Run mitm proxy

``` bash
mitmproxy
```

5. On the victim's machine, browse to any web page!


## Reference

1. https://github.com/mitmproxy/mitmproxy

2. https://blog.heckel.xyz/2013/07/01/how-to-use-mitmproxy-to-read-and-modify-https-traffic-of-your-phone/

