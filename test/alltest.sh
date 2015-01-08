#!/bin/bash
num=$1
date=$2
video_path=$3

	ffmpeg -i /var/www/ui_auth/head.wmv -vf "drawtext=fontsize=35:fontcolor=white: fontfile=/usr/share/fonts/winfonts/ADOBEGOTHICSTD-BOLD.OTF: text='$num':y=160:x=88: draw=lt(t\,5.2)" -vcodec libx264 -y /var/www/ui_auth/tmp/test_out1.avi
	
	ffmpeg -i /var/www/ui_auth/tmp/test_out1.avi -vf "drawtext=fontsize=35:fontcolor=white: fontfile=/usr/share/fonts/winfonts/ADOBEGOTHICSTD-BOLD.OTF:text='$date':y=160:x=1000: draw=lt(t\,5.2)" -vcodec libx264 -y /var/www/ui_auth/tmp/test_out2.avi
		
	rm /var/www/ui_auth/tmp/test_out1.avi
	
	ffmpeg -i $video_path -s 1080x720 -vf "movie=/var/www/ui_auth/tmp/vec.png,scale=150:90 [movie]; [in] [movie] overlay=main_w-overlay_w-10:main_h-overlay_h-10 [out]" -qscale 5 /var/www/ui_auth/tmp/put8.wmv
	
	ffmpeg -i /var/www/ui_auth/tmp/test_out2.avi -sameq /var/www/ui_auth/tmp/inputfile_01.mpg
	ffmpeg -i /var/www/ui_auth/tmp/put8.wmv -sameq /var/www/ui_auth/tmp/inputfile_02.mpg
	
	rm /var/www/ui_auth/tmp/test_out2.avi
	rm /var/www/ui_auth/tmp/put8.wmv
	
	ffmpeg -i concat:"/var/www/ui_auth/tmp/inputfile_01.mpg|/var/www/ui_auth/tmp/inputfile_02.mpg" -sameq /var/www/ui_auth/videoauth/$num.mpg
	
	rm /var/www/ui_auth/tmp/inputfile_01.mpg
	rm /var/www/ui_auth/tmp/inputfile_02.mpg

