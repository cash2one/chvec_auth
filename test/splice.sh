#!/bin/bash

video_mid=$1
output=$2

#/usr/local/bin/ffmpeg -i $video_mid -f mpegts -b 1500k -r 25 -vcodec libx264 -s 1080x720 -aspect 16:9 -bufsize 6000k -acodec libfaac -ab 96k -ac 2 -ar 22050 -bf 0 -level 30 -y /var/www/FFmpeg/mid.ts

#/usr/local/bin/ffmpeg -i concat:"/var/www/ui_auth/|/var/www/ui_auth/" -vcodec copy -acodec copy /var/www/ui_auth/"$output".ts


	#ffmpeg -i /var/www/ui_auth/head.mpg -sameq /var/www/ui_auth/inputfile_01.mpg
	ffmpeg -i /var/www/ui_auth/put8.wmv -sameq /var/www/ui_auth/inputfile_02.mpg
	ffmpeg -i concat:"/var/www/ui_auth/head.mpg|/var/www/ui_auth/inputfile_02.mpg" -sameq /var/www/ui_auth/outputfile.mpg
