<?php
    class InflectionComponent extends Component {
		public static function singular($plural) {
			$singular = ereg_replace('ildren$', 'ild', $plural);
			$singular = ereg_replace('ies$', 'y', $singular);
			$singular = ereg_replace('s$', '', $singular);
			return $singular;
		}

		public static function plural($singular) {
			if (ereg('y$', $singular)) {
				return ereg_replace('y$', 'ies', $singular);
			}
			if (ereg('ild$', $singular)) {
				return ereg_replace('ild$', 'ildren', $singular);
			}
			return $singular.'s';
		}

		public static function camelCase($string, $first = true) {
			$string = str_replace('-', ' ', $string);
			$string = str_replace('_', ' ', $string);
			$string = ucwords($string);
			if ($first == false) {
				$string = strtolower(substr($string, 0, 1)).substr($string, 1);
			}
			$string = str_replace(' ', '', $string);
			return $string;
		}

		public static function unCamelCase($string) {
			$string = preg_replace('/(?!^)[[:upper:]]/', '_$0', $string);
			$string = strtolower($string);
			return $string;
		}

		public static function humanize($string) {
			$string = InflectionComponent::unCamelCase($string);
			$string = preg_replace('/_|-/', ' ', $string);
			$string = preg_replace('/ {2,}/', ' ', $string);
			$string = cfirst($string);
			return $string;
		}
	}