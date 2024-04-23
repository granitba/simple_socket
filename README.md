# Simple socket

This is a simple php tcp socket script, that listens on a certain port for tcp packets.

## Usage
Navigate in to the directory where the project is located and open a terminal, where you will type this:

```bash
sudo php serv.php
```
This should start the "server" script and occupy the terminal window; so next, open another terminal, the one which will be sending the requests:

```bash
php client.php "Target"
```
It's also doable to send tcp requests manually using something like Netcat or Telnet:

```bash
echo "Target" | netcat localhost 3333 -w1
```
Where localhost is the host where the serv.php is running and 3333 is the port used, w1 simply closes netcat after one second.


## License
[GNU General Public License v3.0](https://github.com/granitba/simple_socket/blob/master/LICENSE.md)
