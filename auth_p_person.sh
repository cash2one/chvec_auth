#!/bin/bash
num=$1
date=$2
ID=$3
purpose=$4
video_path=$5
suf=$6
period=$7
time=$8


	/root/bin/ffmpeg -i /var/www/chvec_auth/header.mp4 -vf "drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text=授权'$num':y=110:x=115: draw=lt(t\,5),drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF: text='$purpose':y=110:x=335: draw=lt(t\,5),drawtext=fontsize=25:fontcolor=white: fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF:text=有效期至'$date':y=110:x=865: draw=lt(t\,5)" -qscale 3 -y /var/www/chvec_auth/tmp/$num.mpg
	
	#/root/bin/ffmpeg -i $video_path -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg
	
	#drawtext="fontsize=25:fontfile=FreeSerif.ttf:text=LONG_LINE:y=line_h:x=-50*t"
	#2秒后字体从左到右移动：
	#/root/bin/ffmpeg -i /var/www/chvec_auth/1.mp4 -vf "drawtext=fontsize=25:fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF:text=授权码：CP10323132144         有效期：2014-10-08   :x='if(gte(t\,2)\,((t-2)*80)-w\,NAN)':y=0" -y /var/www/chvec_auth/test1.mpg

	#/root/bin/ffmpeg -i /var/www/chvec_auth/video/6.mp4 -vf "drawtext=fontsize=25:fontfile=/usr/share/fonts/winfonts/SIMHEI.TTF:text=授权'$num'             有效期至'$date'   :fontcolor=white@0.5:x='if(gte(t\,2)\,((t-2)*80)-w\,NAN)':y=line_h" -y /var/www/chvec_auth/test1.mpg
	
	#处理视频添加ChinaVEC的文字logo，位置右下角自适应视频画面，常在#	
	/root/bin/ffmpeg -i $video_path -vf "drawtext=fontsize=45:fontcolor=#C9C9C9@0.9: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=China:y=h-text_h-line_h:x=w-2.2*text_w: enable=lt(mod(t\,$period)\,$time),drawtext=fontsize=45:fontcolor=red@0.5: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=VEC:y=h-text_h-line_h:x=w-1.6*text_w: enable=lt(mod(t\,$period)\,$time)" -y -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg



    #处理视频添加ChinaVEC的logo，位置右下角固定位置，每60秒钟出现5秒钟#
		#/root/bin/ffmpeg -i $video_path -vf "drawtext=fontsize=35:fontcolor=white@0.2: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=China:y=680:x=1080: draw=lt(mod(t\,60)\,5),drawtext=fontsize=35:fontcolor=red@0.2: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=VEC:y=680:x=1190: draw=lt(mod(t\,60)\,5)" -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg

	#处理视频添加ChinaVEC的文字logo，位置右下角自适应视频画面，每40秒钟出现5秒钟#	
       #/root/bin/ffmpeg -i $video_path -vf "drawtext=fontsize=35:fontcolor=white@0.5: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=China:y=h-text_h-line_h:x=w-2*text_w: draw=lt(mod(t\,$period)\,$time),drawtext=fontsize=35:fontcolor=red@0.6: fontfile=/usr/share/fonts/winfonts/AgencyFB.ttf: text=VEC:y=h-text_h-line_h:x=w-1.6*text_w: draw=lt(mod(t\,$period)\,$time)" -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg
	
	##处理视频添加ChinaVEC的图片logo，位置右下角自适应视频画面，每$period秒钟出现$time秒钟#
	#/root/bin/ffmpeg -i $video_path -vf "movie=/var/www/chvec_auth/img/vec2.png, scale=98:26 [movie]; [in] [movie]overlay=main_w-overlay_w-10:main_h-overlay_h-10:enable=lt(mod(t\,$period)\,$time) [out]" -qscale 3 /var/www/chvec_auth/tmp/$ID.mpg

	/root/bin/ffmpeg -i concat:"/var/www/chvec_auth/tmp/$num.mpg|/var/www/chvec_auth/tmp/$ID.mpg" -qscale 3 /var/www/chvec_auth/video_auth/$num.$suf
	
	rm /var/www/chvec_auth/tmp/$num.mpg
	rm /var/www/chvec_auth/tmp/$ID.mpg
