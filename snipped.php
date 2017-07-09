<?php

if ('eselon' == '1') {
	kolom = 1;

}elseif('eselon' == '2'){
	kolom = 2;

}elseif ('eselon' == '3' OR 'golongan' == '4') {
	kolom = 3;

}elseif ('eselon' == '4' OR 'golongan' == '3') {
	kolom = 4;

}else{
	kolom = 5;
}