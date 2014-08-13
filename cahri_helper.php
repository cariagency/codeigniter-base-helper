<?php

	if (!function_exists('sinon'))
	{
		function sinon($param, $sinon = '')
		{
	        if ($param)
	            return $param;
	        else
	            return $sinon;
	    }
	}

	if (!function_exists('presuffixe'))
	{
	    function presuffixe($avant, $param, $apres = '', $sinon = '')
	    {
	       if ($param)
	            return $avant . $param . $apres;
	        else
	            return $sinon;
	    }
	}

	if (!function_exists('array_remove'))
	{
		function array_remove($array, $needle)
		{
			while (($key = array_search($needle, $array)) !== FALSE)
			{
				unset($array[$key]);
			}
			return $array;
	    }
	}

	if (!function_exists('safe_referrer'))
	{
		function safe_referrer()
		{
			$CI =& get_instance();
			$CI->load->library('user_agent');
			return $CI->agent->referrer();
	    }
	}

	if (!function_exists('date_to_mysql'))
	{
		function date_to_mysql($value)
		{
			if ($value) {
				$d = explode('/', $value);
				$value = "$d[2]-$d[1]-$d[0]";
			}
			return $value;
		}
	}

	if (!function_exists('date_from_mysql'))
	{
		function date_from_mysql($value)
		{
			if ($value && substr($value, 0, 4) != '0000')
			{
				$d = explode('-', substr($value, 0, 10));
				$value = "$d[2]/$d[1]/$d[0]";
			}
			else
			{
				$value = '';
			}
			return $value;
		}
	}

	if (!function_exists('numeric_to_mysql'))
	{
		function numeric_to_mysql($value)
		{
			return preg_replace('/[^0-9]/', '', $value);
		}
	}

	if (!function_exists('phone_to_mysql'))
	{
		function phone_to_mysql($value)
		{
			if ($value)
			{
				$value = numeric_to_mysql($value);
				$value = '33'.substr($value, 1);
			}
			return $value;
		}
	}

	if (!function_exists('phone_from_mysql'))
	{
		function phone_from_mysql($value)
		{
			if ($value)
			{
				$phone = '0'.substr($value, 2);
				return substr($phone, 0,2).' '.substr($phone, 2,2).' '.substr($phone, 4,2).' '.substr($phone, 6,2).' '.substr($phone, 8,2);
			}
			else
			{
				return '';
			}
		}
	}

