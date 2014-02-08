<?php
	error_reporting(E_ERROR);

	$GLOBALS['finalDom'] = new DOMDocument();
	$GLOBALS['currentURL'] = '';
	ini_set('max_execution_time', 1000);

	class CLSTART {

		function CLSTART(){
		}
		function run(){
			$dom = new DOMDocument;
			$dom->loadHTMLFile('C:\xampp\htdocs\CLJOB\lib\CL_Cities.html');
			foreach ($dom->getElementsByTagName('a') as $node) {
				$GLOBALS['currentURL'] = $node->getAttribute('href');
				$url = $node->getAttribute('href'). "/search/sof?zoomToPosting=&catAbb=sof&query=+&addOne=telecommuting&excats=";
				$html = $this->cl_get($url);
				$filtered_elements = $this->cl_filter_elements($html, 'date');
				$this->cl_filter_elements_by_date($filtered_elements);
			}
			
				//$url = $dom->getElementsByTagName('a')->item(10)->getAttribute('href'). "/search/sof?zoomToPosting=&catAbb=sof&query=+&addOne=telecommuting&excats=";

	//$GLOBALS['currentURL'] = $dom->getElementsByTagName('a')->item(10)->getAttribute('href');
				//$html = $this->cl_get($url);
				//$filtered_elements = $this->cl_filter_elements($html, 'date');
				//$this->cl_filter_elements_by_date($filtered_elements);

			echo $GLOBALS['finalDom']->saveHTML();
		}

		function cl_get($url){
			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);  

			$html = curl_exec($ch);

			curl_close($ch);

			return $html;
		}

		function cl_filter_elements($html, $classname){
			$domfilter = new DOMDocument;
			$domfilter->loadHTML($html);
			$xpath = new DOMXPath($domfilter);

			$results = $xpath->query("//*[@class='row']");

			foreach ($results as $node) {
				$domAttribute = $domfilter->createAttribute('root-url');
				// Value for the created attribute
				$domAttribute->value = $GLOBALS['currentURL']; 

				// Don't forget to append it to the element
				$node->appendChild($domAttribute);
			}
			return $results;
		}

		function cl_filter_elements_by_date($filtered_elements){

			foreach ($filtered_elements as $node) {
				$this->cl_append_node($node);
				//$keep = $this->cl_desired_date($node->nodeValue, 7);

				//if ($keep == 1) {
					//array_push($element_array,$node);
				//}
			}
		}

		function cl_desired_date($datestring, $max_days){
			$now = time();
			$element_date = strtotime($datestring);

			$datediff = $now - $element_date;
			$days_diff = floor($datediff/(60*60*24));

			$desired =  $days_diff > $max_days? 0 : 1;
			return $desired;
		}

		function cl_append_node($node){
			$cloned = $node->cloneNode(TRUE);
			$GLOBALS['finalDom']->appendChild($GLOBALS['finalDom']->importNode($node,TRUE));


		}
	}
?>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
	$( document ).ready(function() {
		$('.row').hide();
		$('.row').filter(function(){
			if($(this).find('.i').attr('href')[0] == '/'){
				$(this).find('a').attr('href',$(this).attr('root-url') + $(this).find('.i').attr('href'));
			}
			return DateDiff(new Date(),new Date($(this).find('.date').text()+', 2014')) <=1;
		}).show();
	});

	function DateDiff(date1, date2) {
	    date1.setHours(0);
	    date1.setMinutes(0, 0, 0);
	    date2.setHours(0);
	    date2.setMinutes(0, 0, 0);
	    var datediff = Math.abs(date1.getTime() - date2.getTime()); // difference 
	    return parseInt(datediff / (24 * 60 * 60 * 1000), 10); //Convert values days and return value      
	}
</script>
