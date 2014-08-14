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

	/*
	 *	Returns the safe referrer, ie. without redirecting to a third-party website
	 */
	if (!function_exists('safe_referrer'))
	{
		function safe_referrer($sinon = '')
		{
			$CI =& get_instance();
			$CI->load->library('user_agent');
			return sinon(internal_link($CI->agent->referrer()), site_url($sinon));
	    }
	}

	/*
	 *	Returns a safe link: if we are on the website, returns the link, if we go elsewhere, returns false
	 */
	if (!function_exists('internal_link'))
	{
		function internal_link($link)
		{
			if (!$link) return FALSE;
			if (!preg_match('/^https?:\/\//', $link)) $link = site_url($link);
			if (strpos($link, site_url()) === 0) return $link;
			else return FALSE;
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

	if (!function_exists('yes_no_ratio'))
	{
		/*
		 * Calculates a yes/no ratio where the biggest value return 1 and the lowest the cross-multiplication result
		 * Example: 
		 *		<div class="rating">
		 *			<span class="yes" style="width:<?=round(yes_no_ratio($yes, $no)*100)?>%;">oui</span>
		 *			<span class="no" style="width:<?=round(yes_no_ratio($no, $yes)*100)?>%;">non</span>
		 *		</div>
		 * With $votes = {yes: 2, no: 1}, render as :
		 *      [==========]
		 *      [=====]
		 */

		function yes_no_ratio($yes, $no)
		{
			if ($yes > $no)
			{
				return 1;
			}
			elseif ($no == 0)
			{
				return 0;
			}
			else
			{
				return $yes/$no;
			}
		}
	}

	if( ! function_exists('uncamelize'))
	{
	    function uncamelize($str, $delimiter=' ')
	    {
	        $str = strtolower(preg_replace('/([A-Z])/', $delimiter.'$1', $str));
	        return $str;
	    }
	}

	if( ! function_exists('is_foreachable'))
	{
		function  is_foreachable(&$var)
		{
  			return  isset($var)  &&  (is_array($var)  ||  ($var  instanceof  Traversable));
		}
	}
