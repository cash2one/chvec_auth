#!/bin/bash

ffmpeg -i /var/www/ui_auth/Wi.wmv -s 1080x720 -vf "movie=/var/www/ui_auth/cuc.png,scale=200:200 [movie]; [in] [movie] overlay=main_w-overlay_w-10:10 [out]" -qscale 5 /var/www/ui_auth/put8.wmv
