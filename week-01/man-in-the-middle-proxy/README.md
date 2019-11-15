# Man-in-the-middle Proxy

# Execution

1. Install mitm proxy on the attacker machine

    Follow the installation guide [here](https://mitmproxy.org/).

    Additional documentation can be found [here](https://docs.mitmproxy.org/stable/)

2. Install the generated mitm CA certificate in the victim's machine

    Visit [mitm](http://mitm.it)

    More information about the installation of the certificate can be found [here](https://docs.mitmproxy.org/stable/concepts-certificates/)

3. Configure proxy setting in victim's machine

    The configuration is dependent on your browser. The default port is 8080.

4. Run mitm proxy

    Go to your Window's search bar and type "mitmproxy ui".

5. On the victim's machine, browse to any web page! Go back to the UI and search for the URL!


## Reference

1. https://github.com/mitmproxy/mitmproxy

2. https://blog.heckel.xyz/2013/07/01/how-to-use-mitmproxy-to-read-and-modify-https-traffic-of-your-phone/

