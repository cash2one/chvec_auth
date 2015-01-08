#!/bin/bash

ffmpeg -i /var/www/ui_auth/Wi.mpg -s 1080x720 -vf "movie=/var/www/ui_auth/cuc200x200.png, scale = 50:50 [movie]; [in] [movie] overlay=main_w-overlay_w-10:10,setdar=16:9 [out]" -an -qscale 5 /var/www/ui_auth/put8.mpg


ffmpeg -i /var/www/ui_auth/Wi.wmv -s 1080x720 -vf "movie=/var/www/ui_auth/cuc.png,scale=200:200 [movie]; [in] [movie] overlay=main_w-overlay_w-10:10 [out]" -qscale 5 /var/www/ui_auth/put8.wmv
