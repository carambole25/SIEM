echo "absolute path to the main.py file (/dir/example/main.py):"
read path_to_main

# Ajouter la commande dans le crontab
(crontab -l 2>/dev/null; echo "*/5 * * * * sudo python3 $path_to_main") | crontab -

echo "Ok !"