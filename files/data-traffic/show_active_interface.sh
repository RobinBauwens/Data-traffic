ip -d link | grep "state UP" | cut -d' ' -f2 | sed 's/://g'