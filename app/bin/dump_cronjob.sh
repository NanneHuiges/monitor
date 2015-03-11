#!/bin/bash

if [ -e /var/run/dumpcron.pid ]; then
  pid=`cat /var/run/dumpcron.pid`
  kill "$pid"
fi

nohup /usr/local/sbin/airodump-ng wlan0 -w dumpcron_out --output-format csv &>/dev/null &
echo $! > /var/run/dumpcron.pid
