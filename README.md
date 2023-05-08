# monitor

Running command in tmux session:
- starting new session: tmux new -s snort
- command running: sudo snort -c /usr/local/etc/snort/snort.lua -R /usr/local/etc/rules/local.rules -i eth0 -q
- to detach session: Press Ctrl + B, then release the keys and press D.
- to attack session: tmux attach -t snort