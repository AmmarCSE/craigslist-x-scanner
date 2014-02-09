<?php
	class CLHTTP {
		public static function cl_get($url){
			$curl_handle = curl_init($url);

			curl_setopt($curl_handle, CURLOPT_HEADER, 0);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);  

			$response = curl_exec($curl_handle);

			curl_close($curl_handle);

			return $response;
		}
	}
?>
