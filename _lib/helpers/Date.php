<?php
class DateHelper extends Helper {
	static function format($date, $format = '{dd} {month} {yyyy}', $empty = 'indéfinie') { 
		if (!$time = strtotime($date)) { 
			return $empty; 
		} 
		$replace = array( 
			'{day}'   => '%A', 
			'{da}'    => '%a', 
			'{dd}'    => '%d', 
			'{month}' => '%B', 
			'{mo}'    => '%b', 
			'{mm}'    => '%m', 
			'{yyyy}'  => '%Y', 
			'{yy}'    => '%y', 
			'{HH}'    => '%H', 
			'{MM}'    => '%M', 
			'{SS}'    => '%S', 
			'{AMPM}'  => '%p', 
		); 
		$format = str_replace(array_keys($replace), array_values($replace), $format); 
		$date   = strftime($format, $time); 
		return $date; 
	} 
	
	static function short($date, $time = false, $empty = 'indéfinie') { 
		if ($time) {
			$format = Config::get('datetime.short', '%d/%m/%Y %H:%M');
		} else {
			$format = Config::get('date.short', '%d/%m/%Y');
		}
		return DateHelper::format($date, $format, $empty);
	}

	static function medium($date, $time = false, $empty = 'indéfinie') { 
		if ($time) {
			$format = Config::get('datetime.medium', '%a %d %b %y, %H:%M');
		} else {
			$format = Config::get('date.medium', '%a %d %b %y');
		}
		return DateHelper::format($date, $format, $empty);
	}
	
	static function long($date, $time = false, $empty = 'indéfinie') { 
		if ($time) {
			$format = Config::get('datetime.long', '%A %d %B %Y, %H:%M');
		} else {
			$format = Config::get('date.long', '%A %d %B %Y');
		}
		return DateHelper::format($date, $format, $empty);
	}
	
	static function prettyFormat($date, $format = '{day} {dd} {month} {yyyy}', $empty = 'indéfinie') { 
		if (!$time = strtotime($date)) { 
			return $empty; 
		} 
		$after           = strtotime("+7 day 00:00"); 
		$afterTomorrow   = strtotime("+2 day 00:00"); 
		$tomorrow        = strtotime("+1 day 00:00"); 
		$today           = strtotime("today 00:00"); 
		$yesterday       = strtotime("-1 day 00:00"); 
		$beforeYesterday = strtotime("-2 day 00:00"); 
		$before          = strtotime("-7 day 00:00"); 
		if ($time < $after && $time > $before) { 
			if ($time >= $after) { 
				$relative = strftime("%A", $date)." prochain"; 
			} else if ($time >= $afterTomorrow) { 
				$relative = "après demain"; 
			} else if ($time >= $tomorrow) { 
				$relative = "demain"; 
			} else if ($time >= $today) { 
				$relative = "aujourd'hui"; 
			} else if ($time >= $yesterday) { 
				$relative = "hier"; 
			} else if ($time >= $beforeYesterday) { 
				$relative = "avant hier"; 
			} else if ($time >= $before) { 
				$relative = strftime("%A", $time)." dernier"; 
			} 
			if (preg_match('/[0-2][0-9]:[0-5][0-9]/', $date)) { 
				$relative .= ' à '.date('H:i', $time); 
			} 
		} else { 
			$relative = 'le '.DateHelper::format($format);
		} 
		return $relative; 
	} 
	
	static function relative($date) { 
		$time = time() - strtotime($date); 
	 
		if ($time > 0) { 
			$when = "il y a"; 
		} else if ($time < 0) { 
			$when = "dans environ"; 
		} else { 
			return "il y a moins d'une seconde"; 
		} 
		$time = abs($time); 
		 
		$times = array( 31104000 =>  'an{s}',       // 12 * 30 * 24 * 60 * 60 secondes 
						2592000  =>  'mois',        // 30 * 24 * 60 * 60 secondes 
						86400    =>  'jour{s}',     // 24 * 60 * 60 secondes 
						3600     =>  'heure{s}',    // 60 * 60 secondes 
						60       =>  'minute{s}',   // 60 secondes 
						1        =>  'seconde{s}'); // 1 seconde         
		 
		foreach ($times as $seconds => $unit) { 
			$delta = round($time / $seconds); 
			 
			if ($delta >= 1) { 
				if ($delta == 1) { 
					$unit = str_replace('{s}', '', $unit); 
				} else { 
					$unit = str_replace('{s}', 's', $unit); 
				} 
				return $when." ".$delta." ".$unit; 
			} 
		} 
	} 
}
