<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 发送HTTP网络请求类
 *
 */
class Network
{
	/**
	 * 执行一个 HTTP 请求
	 *
	 * @param string 	$url 	执行请求的URL
	 * @param mixed	$params 表单参数
	 * 							可以是array, 也可以是经过url编码之后的string
	 * @param string	$method 请求方法 post / get
	 * @param mixed	$cookie cookie参数
	 * 							可以是array, 也可以是经过拼接的string
	 * @param string	$protocol http协议类型 http / https
	 * 
	 * @return array 结果数组
	 */
	static public function doRequest($url, $params=array(), $method='post', $cookie=array(), $protocol='http')
	{   
		$query_string = self::makeQueryString($params);	   
	    $cookie_string = self::makeCookieString($cookie);
	    $ip = self::getIp();
	    	    
	    $ch = curl_init();
	    if ('get' == $method)
	    {
		    curl_setopt($ch, CURLOPT_URL, "$url?$query_string");
	    }
	    else 
        {
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_POST, 1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    }
        
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    	//curl_setopt($ch, CURLOPT_TIMEOUT_MS, 120000);
    	curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com/");   //来路 61.135.169.125
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FORWARDED-FOR:$ip", "CLIENT-IP:$ip"));//IP

        // disable 100-continue
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		//curl_setopt($ch, CURLOPT_INTERFACE,$ip);
	    if (!empty($cookie_string))
	    {
	    	curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
	    }
	    
	    if ('https' == $protocol)
	    {
	    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    }
	
	    $ret = curl_exec($ch);
	    $err = curl_error($ch);
	    if (false === $ret || !empty($err))
	    {
		    $errno = curl_errno($ch);
		    $info = curl_getinfo($ch);
		    curl_close($ch);
	        return array('result' => false,'errno' => $errno,'data' => $err,'info' => $info);
	    }
	    
		curl_close($ch);
		return array('result' => true, 'data' => $ret);  
	}
	
	static private function makeQueryString($params)
	{
		if(is_string($params))
		{
			return $params;
		}

		$query_string = array();
	    foreach ($params as $key => $value)
	    {   
	        array_push($query_string, rawurlencode($key) . '=' . rawurlencode($value));
	    }   
	    $query_string = join('&', $query_string);
	    return $query_string;
	}

	static private function makeCookieString($params)
	{
		if (is_string($params))
		{
			return $params;
		}

		$cookie_string = array();
	    foreach ($params as $key => $value)
	    {   
	        array_push($cookie_string, $key . '=' . $value);
	    }   
	    $cookie_string = join('; ', $cookie_string);
	    return $cookie_string;
	}
	
	static private function getIp()
	{
		$ip_long = array(
            array('607649792', '608174079'), //36.56.0.0-36.63.255.255
            array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
            array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
            array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
            array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
            array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
            array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
            array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
            array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
            array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
        );
        $rand_key = mt_rand(0, 9);
		return long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
	}
}