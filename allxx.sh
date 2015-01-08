#!/bin/bash
num=$1
date=$2
ID=$3
purpose=$4
video_path=$5
suf=$6


	/root/bin/ffmpeg -i /var/www/ui_auth/header.wmv -vf "drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text=授权'$num':y=110:x=115: draw=lt(t\,5),drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text='$purpose':y=110:x=335: draw=lt(t\,5),drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF:text=有效期至'$date':y=110:x=865: draw=lt(t\,5)" -qscale 3 -y /var/www/ui_auth/tmp/$num.mpg
	
	/root/bin/ffmpeg -i $video_path -qscale 3 /var/www/ui_auth/tmp/$ID.mpg

	#处理视频添加ChinaVEC的logo，位置右下角，每60秒钟出现5秒钟#
	#/root/bin/ffmpeg -i $video_path -vf "drawtext=fontsize=35:fontcolor=white: fontfile=/usr/share/fonts/winfonts/CAT978.ttf: text=China:y=680:x=1080: draw=lt(mod(t\,60)\,5),drawtext=fontsize=35:fontcolor=red: fontfile=/usr/share/fonts/winfonts/CAT978.ttf: text=VEC:y=680:x=1190: draw=lt(mod(t\,60)\,5)" -qscale 3 /var/www/ui_auth/tmp/$ID.mpg
	
	/root/bin/ffmpeg -i concat:"/var/www/ui_auth/tmp/$num.mpg|/var/www/ui_auth/tmp/$ID.mpg" -qscale 3 /var/www/ui_auth/video_auth/$num.$suf
	
	rm /var/www/ui_auth/tmp/$num.mpg
	rm /var/www/ui_auth/tmp/$ID.mpg

