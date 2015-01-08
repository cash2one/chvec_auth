#!/bin/bash
    suf=$1
	ffmpeg -i /var/www/ui_auth/header.wmv -qscale 3 /var/www/ui_auth/tmp/inputfile_02.$suf
