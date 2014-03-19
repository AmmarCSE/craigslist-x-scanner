<?php
	require_once("cl_ifilter.php");
	class CLREGEXFILTER implements iFilter
	{
		public function cl_filter_by_class($html, $classname){
//echo preg_match("p", $html);
//echo $html;
preg_match("/<p ?.*>(.*)<\/p>/", $html, $matches, PREG_OFFSET_CAPTURE);
print_r($matches);
		}
		public function cl_filter_elements_by_date($filtered_elements){

		}
	}
?>
