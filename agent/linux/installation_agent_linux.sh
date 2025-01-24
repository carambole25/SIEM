#!/bin/bash

echo "Absolute path to the main.py file (example : /dir/example/main.py):"
read path_to_main

sudo chown root:root "$path_to_main"

sudo chmod +x "$path_to_main"

sudo bash -c "(sudo crontab -l 2>/dev/null; echo \"*/5 * * * * python3 $path_to_main\") | sudo crontab -"

echo "Ok !"
