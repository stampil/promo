<?php

class Richards_Toolbox {
	function checkGZIPCompression($url) {
		$result = file_get_contents('http://checkgzipcompression.com/js/checkgzip.json?url=' . $url);
		return json_decode($result);
	}

	function enableGZIPCompression() {
		update_option( 'richards-toolbox-gzip-enabled', 1 );
	}

	function disableGZIPCompression() {
		update_option( 'richards-toolbox-gzip-enabled', 0 );
	}
}