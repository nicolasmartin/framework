<?


function cFirst($string) {
	$string = strtolower($string);
	$replaced = strtr($string, 
				'äâàáåãéèëêòóôõöøìíîïùúûüýñçþÿæœðø', 
				'ÄÂÀÁÅÃÉÈËÊÒÓÔÕÖØÌÍÎÏÙÚÛÜÝÑÇÞÝÆŒÐØ');
	$string = substr(utf8_decode($replaced), 0, 1).substr(utf8_decode($string), 1);
	return $string;
}
echo cFirst('écéço');
?>