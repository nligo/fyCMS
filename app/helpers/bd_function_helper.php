<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 截取字符串
 * @param $str string 要截取的字符串
 * @param $limit integer 要截取的长度,尽量用3的倍数
 * @param $end_char string 超长后补充字符
 */
if ( ! function_exists('cut_string')){
	function cut_string($str, $limit = 100, $end_char = '...'){
	    if (extension_loaded('mbstring') == TRUE){//开启了mbstring
	        if(mb_strlen($str) > $limit){
	            return mb_substr($str, 0, $limit).$end_char;
	        } else {
	            return $str;
	        }
	    }

		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $str, $t_string);
        if(count($t_string[0]) > $limit) return join('', array_slice($t_string[0], 0, $limit)).$end_char;
        return join('', array_slice($t_string[0], 0, $limit));
    }
}


/**********************************************************
 * 获取当前时间的微秒
 */
 function get_now_time(){
	list($s1, $s2) = explode(' ', microtime());
	return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}
/**
 * 将微秒转化时间格式Y-m-d H:i:s
 * */
 function get_time_format($time){
 	$len=strlen($time);
 	if($len==13){
 		$format_time= substr($time, 0,10);
 		return date('Y-m-d',$format_time);
 	}else{
 		return date('Y-m-d',$time);
 	}

}

function time_tran($time){
     

    $the_time= substr($time, 0,10);

    $now_time = date("Y-m-d H:i:s",time());

    $now_time = strtotime($now_time);
    $show_time = $the_time;
    $dur = $now_time - $show_time;
    if($dur < 0){
        return $the_time;
    }else{
        if($dur < 60){
            return $dur.'秒前';
        }else{
            if($dur < 3600){
                return floor($dur/60).'分钟前';
            }else{
                if($dur < 86400){
                    return floor($dur/3600).'小时前';
                }else{
                    if($dur < 259200){//3天内
                        return floor($dur/86400).'天前';
                    }else{
                        return date('Y-m-d H:i',$the_time);
                    }
                }
            }
        }
    }
}
/**
 * 一周时间
 * */
function formart_week($time_year,$weekNum){
    
    if ($time_year%4==0 && ($time_year%100!=0 || $time_year%400==0)){
        $days=366;
    }else{
        $days=365;
    }
    $weeks=date("W",mktime(0,0,0,12,31,$time_year));//计算一年有多少个星期
    
    $time=mktime(0,0,0,1,1,$time_year);//计算当年开始的时间
     
    for($i=0;$i<=$days;$i++){
        $time_array[date("W",$time+$i*86400)][]=date("Y-m-d",$time+$i*86400);
    }
    
    for($i=1;$i<=$weeks;$i++){
        if ($i<10) {
            $week_have_days[$i]=$time_array["0".$i];}else{$week_have_days[$i]=$time_array[$i];
            }
    }
    
    for($i=1;$i<=count($week_have_days);$i++){
        if($i==$weekNum){
//             if($dayNum>0){
//                 $title=$week_have_days[$i][0];
//             }else{
                $title['title']=$week_have_days[$i][0]."（周一）至".$week_have_days[$i][count($week_have_days[$i])-1]."（周日）";
                $title['stime']=$week_have_days[$i][0];
                $title['etime']=$week_have_days[$i][count($week_have_days[$i])-1];
                
            //}
        }
    }
    
    return $title;
}

/**
 * 格式化时间
 * */
 function formart_week_day($menuList){
     
    $dayTime = mb_substr($menuList, 0,2);
   
    switch ($dayTime)
    {
        case '周一':
            $dayNum=1;
            break;
        case '周二':
            $dayNum=2;
            break;
        case '周三':
            $dayNum=3;
            break;
        case '周四':
            $dayNum=4;
            break;
        case '周五':
            $dayNum=5;
            break;
        case '周六':
            $dayNum=6;
            break;
        case '周日':
            $dayNum=0;
            break;
             
    }

    return $dayNum;
    
}
/* End */