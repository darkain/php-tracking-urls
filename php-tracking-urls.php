<?php

function get_tracking_url($tracking_number) {
	$php_tracking_urls = array(
		array(
			'url'=>'http://wwwapps.ups.com/WebTracking/processInputRequest?TypeOfInquiryNumber=T&InquiryNumber1=',
			'reg'=>'/\b(1Z ?[0-9A-Z]{3} ?[0-9A-Z]{3} ?[0-9A-Z]{2} ?[0-9A-Z]{4} ?[0-9A-Z]{3} ?[0-9A-Z]|[\dT]\d\d\d ?\d\d\d\d ?\d\d\d)\b/i'
		),
		array(
			'url'=>'https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1=',
			'reg'=>'/\b((420 ?\d\d\d\d\d ?)?(91|94|01|03|04|70|23|13)\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d\d\d( ?\d\d)?)\b/i'
		),
		array(
			'url'=>'https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1=',
			'reg'=>'/\b((M|P[A-Z]?|D[C-Z]|LK|EA|V[A-Z]|R[A-Z]|CP|CJ|LC|LJ) ?\d\d\d ?\d\d\d ?\d\d\d ?[A-Z]?[A-Z]?)\b/i'
		),
		array(
			'url'=>'http://www.fedex.com/Tracking?language=english&cntry_code=us&tracknumbers=',
			'reg'=>'/\b((96\d\d\d\d\d ?\d\d\d\d|96\d\d|\d\d\d\d) ?\d\d\d\d ?\d\d\d\d( ?\d\d\d)?)\b/i'
		),
		array(
			'url'=>'http://www.ontrac.com/trackres.asp?tracking_number=',
			'reg'=>'/\b(C\d\d\d\d\d\d\d\d\d\d\d\d\d\d)\b/i'
		),
		array(
			'url'=>'http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=',
			'reg'=>'/\b(\d\d\d\d ?\d\d\d\d ?\d\d)\b/i'
		),
	);

	foreach ($php_tracking_urls as $item) {
		$match = array();
		preg_match($item['reg'], $tracking_number, $match);
		if (count($match)) return $item['url'] . $match[0];
	}
	return false;
}


//Attach this to AltaForm if available
if (!empty($afurl)  &&  is_a($afurl, 'af_url')) {
	$afurl->tracking = 'get_tracking_url';
}
