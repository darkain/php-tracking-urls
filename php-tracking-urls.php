<?php

function get_tracking_url($tracking_number) {
	if (empty($tracking_number)) return false;
	if (!is_string($tracking_number)  &&  !is_int($tracking_number)) return false;

	static $tracking_urls = [
		//UPS - UNITED PARCEL SERVICE
		[
			'url'=>'http://wwwapps.ups.com/WebTracking/processInputRequest?TypeOfInquiryNumber=T&InquiryNumber1=',
			'reg'=>'/\b(1Z ?[0-9A-Z]{3} ?[0-9A-Z]{3} ?[0-9A-Z]{2} ?[0-9A-Z]{4} ?[0-9A-Z]{3} ?[0-9A-Z]|T\d{3} ?\d{4} ?\d{3})\b/i'
		],

		//USPS - UNITED STATES POSTAL SERVICE - FORMAT 1
		[
			'url'=>'https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1=',
			'reg'=>'/\b((420 ?\d{5} ?)?(91|92|93|94|95|01|03|04|70|23|13)\d{2} ?\d{4} ?\d{4} ?\d{4} ?\d{4}( ?\d{2,6})?)\b/i'
		],

		//USPS - UNITED STATES POSTAL SERVICE - FORMAT 2
		[
			'url'=>'https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1=',
			'reg'=>'/\b((M|P[A-Z]?|D[C-Z]|LK|E[A-C]|V[A-Z]|R[A-Z]|CP|CJ|LC|LJ) ?\d{3} ?\d{3} ?\d{3} ?[A-Z]?[A-Z]?)\b/i'
		],

		//USPS - UNITED STATES POSTAL SERVICE - FORMAT 3
		[
			'url'=>'https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1=',
			'reg'=>'/\b(82 ?\d{3} ?\d{3} ?\d{2})\b/i'
		],

		//FEDEX - FEDERAL EXPRESS
		[
			'url'=>'http://www.fedex.com/Tracking?language=english&cntry_code=us&tracknumbers=',
			'reg'=>'/\b(((96\d\d|6\d)\d{3} ?\d{4}|96\d{2}|\d{4}) ?\d{4} ?\d{4}( ?\d{3})?)\b/i'
		],

		//ONTRAC
		[
			'url'=>'http://www.ontrac.com/trackres.asp?tracking_number=',
			'reg'=>'/\b(C\d{14})\b/i'
		],

		//DHL
		[
			'url'=>'http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=',
			'reg'=>'/\b(\d{4}[- ]?\d{4}[- ]?\d{2}|\d{3}[- ]?\d{8}|[A-Z]{3}\d{7})\b/i'
		],
	];


	//TEST EACH POSSIBLE COMBINATION
	foreach ($tracking_urls as $item) {
		$match = array();
		preg_match($item['reg'], $tracking_number, $match);
		if (count($match)) {
			return $item['url'] . preg_replace('/\s/', '', strtoupper($match[0]));
		}
	}


	// TRIM LEADING ZEROES AND TRY AGAIN
	// https://github.com/darkain/php-tracking-urls/issues/4
	if (substr($tracking_number, 0, 1) === '0') {
		return get_tracking_url(ltrim($tracking_number, '0'));
	}


	//NO MATCH FOUND, RETURN FALSE
	return false;
}
