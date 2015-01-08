#!/bin/bash
num=$1
date=$2
purpose=$3
video_path=$4

	/root/bin/ffmpeg -i /var/www/ui_auth/header.wmv -vf "drawtext=fontsize=35:fontcolor=white: fontfile=/usr/share/fonts/winfonts/ADOBEGOTHICSTD-BOLD.OTF: text='$num':y=163:x=95: draw=lt(t\,5.2)" -vcodec libx264 -y /var/www/ui_auth/tmp/test_out1.avi
	
	/root/bin/ffmpeg -i /var/www/ui_auth/tmp/test_out1.avi -vf "drawtext=fontsize=35:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text='$purpose':y=160:x=320: draw=lt(t\,5.2)" -vcodec libx264 -y /var/www/ui_auth/tmp/test_out2.avi

	/root/bin/ffmpeg -i /var/www/ui_auth/tmp/test_out2.avi -vf "drawtext=fontsize=35:fontcolor=white: fontfile=/usr/share/fonts/winfonts/ADOBEGOTHICSTD-BOLD.OTF:text='$date':y=160:x=1000: draw=lt(t\,5.2)" -vcodec libx264 -y /var/www/ui_auth/tmp/test_out3.avi
		
	rm /var/www/ui_auth/tmp/test_out1.avi

	rm /var/www/ui_auth/tmp/test_out2.avi
	
	#ffmpeg -i $video_path -s 1080x720 -vf "movie=/var/www/ui_auth/tmp/vec.png,scale=150:90 [movie]; [in] [movie] overlay=main_w-overlay_w-10:main_h-overlay_h-10 [out]" -qscale 5 /var/www/ui_auth/tmp/put8.wmv
	
	/root/bin/ffmpeg -i /var/www/ui_auth/tmp/test_out3.avi /var/www/ui_auth/tmp/inputfile_01.mpg
	/root/bin/ffmpeg -i $video_path /var/www/ui_auth/tmp/inputfile_02.mpg
	
	rm /var/www/ui_auth/tmp/test_out3.avi
	#rm /var/www/ui_auth/tmp/put8.wmv
	
	/root/bin/ffmpeg -i concat:"/var/www/ui_auth/tmp/inputfile_01.mpg|/var/www/ui_auth/tmp/inputfile_02.mpg" /var/www/ui_auth/videoauth/$num.mpg
	
	rm /var/www/ui_auth/tmp/inputfile_01.mpg
	rm /var/www/ui_auth/tmp/inputfile_02.mpg
