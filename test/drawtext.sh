#!/bin/bash
num=$1
time=$2

	ffmpeg -i /var/www/ui_auth/chead.wmv -vf "drawtext=fontsize=30: fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text='$num':y=78:x=130: box=1: boxcolor=green@0.2" -vcodec libx264 -y /var/www/ui_auth/test_out1.avi
	
	ffmpeg -i /var/www/ui_auth/test_out1.avi -vf "drawtext=fontsize=30:fontcolor=white:fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF:text='$time':y=75:x=748: box=1: boxcolor=green@0.2" -vcodec libx264 -y /var/www/ui_auth/test_out.avi
	
	rm /var/www/ui_auth/test_out1.avi
