#!/usr/bin/env bash

#
#
# Delete the html sent files
#
if ! rm -r /var/www/html/wsent.txt; then
    echo "Failed to delete /var/www/html/wsent.txt"
fi
echo "Successfully deleted /var/www/html/wsent.txt."
if ! rm -r /var/www/html/dmssent.txt; then
    echo "Failed to delete /var/www/html/dmssent.txt"
fi
echo "Successfully deleted /var/www/html/dmssent.txt."
#
#
# Update the timestamp
#
if ! bash /var/www/html/dms-update.sh; then
    echo "Failed to update the timestamp."
fi
echo "Successfully update the timestamp."
