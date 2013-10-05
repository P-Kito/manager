<?php

/*
 *	Manager für Texte
 */

class TextMgr 
{
	static function getText($what, $ignore, $withBR = true, $replace = array())
	{
		$query = "SELECT text FROM tbltext WHERE idText='".$what."'";
		$result = MySQLMgr::executeSingle($query, true);
		if ($result == "" && !$ignore)
		{
			return($what);
		}
		else
		{
			if ($withBR == true)
				return(nl2br(self::makelink($result)));
			elseif ($withBR == false)
				return(vsprintf($result, $replace));
		}
	}

	static function autolink($str, $attributes=array())
	{
		$attrs = '';
		foreach ($attributes as $attribute => $value) {
			$attrs .= " {$attribute}=\"{$value}\"";
		}
		$str = ' ' . $str;
		$str = preg_replace(
		  '`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i',
		  '$1<a href="$2"'.$attrs.'>$2</a>',
		  $str
		);
		$str = substr($str, 1);
		$str = preg_replace('`href=\"www`','href="http://www',$str);
		// fügt http:// hinzu, wenn nicht vorhanden
		return $str;
	}
	

	function makeLink ($string) {

    	$string = str_replace("http://www.","www.", $string);    
    	$string = str_replace("www.","http://www.", $string);
    	$string = preg_replace('/([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[\.a-zA-ZöÖüÜäÄ0-9-]+\.([a-zA-Z]{2,5}))/', 'mailto:$1', $string);

    	$url_patterns = array(
    	    'http'      => "(?:https?://(?:(?:(?:(?:(?:[a-zA-Z\d](?:(?:[a-zA-Z\d]|-)*[a-zA-Z\d])?)\.)*(?:[a-zA-Z](?:(?:[a-zA-Z\d]|-)*[a-zA-Z\d])?))|(?:(?:\d+)(?:\.(?:\d+)){3}))(?::(?:\d+))?)(?:/(?:(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[;:@&=])*)(?:/(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[;:@&=])*))*)(?:\?(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[;:@&=])*))?)?)",
  	      'ftp'       => "(?:ftp://(?:(?:(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[;?&=])*)(?::(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[;?&=])*))?@)?(?:(?:(?:(?:(?:[a-zA-Z\d](?:(?:[a-zA-Z\d]|-)*[a-zA-Z\d])?)\.)*(?:[a-zA-Z](?:(?:[a-zA-Z\d]|-)*[a-zA-Z\d])?))|(?:(?:\d+)(?:\.(?:\d+)){3}))(?::(?:\d+))?))(?:/(?:(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[?:@&=])*)(?:/(?:(?:(?:[a-zA-Z\d$\-_.+!*'(),]|(?:%[a-fA-F\d]{2}))|[?:@&=])*))*)(?:;type=[AIDaid])?)?)",
   	     'mailto'    => "(?:mailto:(?:(?:[a-zA-Z\d$\-_.+!*'(),;/?:@&=]|(?:%[a-fA-F\d]{2}))+))"
   	 );

   	 $pattern = '/(' . addcslashes($url_patterns['http'], chr(0x2F)) . '|' . addcslashes($url_patterns['ftp'], chr(0x2F)) . '|' . addcslashes($url_patterns['mailto'], chr(0x2F)) . ')/';
  	  $string = preg_replace($pattern, "<a href=\"\\1\">\\1</a>", $string);
	
  	  return $string;
	}
}