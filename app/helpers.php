<?php
function generateOTP( $digits = 5 ) {
	return rand(pow(10, $digits-1), pow(10, $digits)-1);
}