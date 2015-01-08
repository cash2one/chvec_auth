#!/bin/bash
num=$1
date=$2
ID=$3
purpose=$4
video_path=$5
suf=$6


	/root/bin/ffmpeg -i /var/www/chvec_auth/header.wmv -vf "drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text=授权'$num':y=110:x=115: draw=lt(t\,5),drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text='$purpose':y=110:x=330: draw=lt(t\,5),drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF:text=有效期至'$date':y=110:x=885: draw=lt(t\,5)" -qscale 3 -y /var/www/chvec_auth/tmp/$num.mpg
	
	#/root/bin/ffmpeg -i $video_path -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg

    #处理视频添加ChinaVEC的logo，位置右下角固定位置，每60秒钟出现5秒钟#
		#/root/bin/ffmpeg -i $video_path -vf "drawtext=fontsize=35:fontcolor=white@0.2: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=China:y=680:x=1080: draw=lt(mod(t\,60)\,5),drawtext=fontsize=35:fontcolor=red@0.2: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=VEC:y=680:x=1190: draw=lt(mod(t\,60)\,5)" -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg

	#处理视频添加ChinaVEC的logo，位置右下角自适应视频画面，每40秒钟出现5秒钟#	
       #/root/bin/ffmpeg -i $video_path -vf "drawtext=fontsize=35:fontcolor=white@0.3: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf.ttf: text=China:y=h-text_h-line_h:x=w-2*text_w: draw=lt(mod(t\,40)\,5),drawtext=fontsize=35:fontcolor=red@0.3: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=VEC:y=h-text_h-line_h:x=w-1.6*text_w: draw=lt(mod(t\,40)\,5)" -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg
	
	/root/bin/ffmpeg -i $video_path -vf "movie=/var/www/chvec_auth/img/vec.png, scale=150:90 [movie]; [in] [movie]overlay=main_w-overlay_w-10:main_h-overlay_h-10:enable=lt(mod(t\,40)\,5) [out]" -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg

	/root/bin/ffmpeg -i concat:"/var/www/chvec_auth/tmp/$num.mpg|/var/www/chvec_auth/tmp/$ID.mpg" -qscale 3 /var/www/chvec_auth/video_auth/$num.$suf
	
	rm /var/www/chvec_auth/tmp/$num.mpg
	rm /var/www/chvec_auth/tmp/$ID.mpg
