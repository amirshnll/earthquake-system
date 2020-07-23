<?php

	/**
	 * Json Class
	 */
	class json
	{

		public function __construct() {
			$this->sonUpdatedTime["PastHour"]		=	time();
			$this->sonUpdatedTime["PastDay"]		=	time();
			$this->sonUpdatedTime["Past7Days"]		=	time();
			$this->sonUpdatedTime["Past30Days"]		=	time();
		}

		public $josnOnlineFileAddress = array (
			"PastHour"		=>		"https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_hour.geojson",
			"PastDay"		=>		"https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson",
			"Past7Days"		=>		"https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_week.geojson",
			"Past30Days"	=>		"https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_month.geojson",
		);

		public $josnOfflineFileAddress = array (
			"PastHour"		=>		"cache/PastHour.json",
			"PastDay"		=>		"cache/PastDay.json",
			"Past7Days"		=>		"cache/Past7Days.json",
			"Past30Days"	=>		"cache/Past30Days.json",
		);

		public $jsonUpdatedTime = array (
			"PastHour"		=>		0,
			"PastDay"		=>		0,
			"Past7Days"		=>		0,
			"Past30Days"	=>		0,
		);

		public function isJson($jsonData) {
			return ((is_string($jsonData) &&
            	(is_object(json_decode($jsonData)) ||
            		is_array(json_decode($jsonData))))) ? true : false;
		}

		public function getPastHour() {

			if(file_exists($this->josnOfflineFileAddress["PastHour"]) && time() - filemtime($this->josnOfflineFileAddress["PastHour"]) < 2000) {
				$file = fopen($this->josnOfflineFileAddress["PastHour"], "r");
				$jsonData = fread($file, filesize($this->josnOfflineFileAddress["PastHour"]));
				fclose($file);
				if($this->isJson($jsonData)) {
					$this->jsonUpdatedTime['PastHour'] = filemtime($this->josnOfflineFileAddress["PastHour"]);
					return json_decode($jsonData, true);
				}
			}
			$jsonData = null;

			$jsonData = @file_get_contents($this->josnOnlineFileAddress["PastHour"]);
			if($this->isJson($jsonData)) {
				$this->updateData($jsonData, "PastHour");
				$this->jsonUpdatedTime['PastHour'] = time();
				return json_decode($jsonData, true);
			} else {
				if(file_exists($this->josnOfflineFileAddress["PastHour"])) {
					$file = fopen($this->josnOfflineFileAddress["PastHour"], "r");
					$jsonData = fread($file, filesize($this->josnOfflineFileAddress["PastHour"]));
					fclose($file);
					if($this->isJson($jsonData)) {
						$this->jsonUpdatedTime['PastHour'] = filemtime($this->josnOfflineFileAddress["PastHour"]);
						return json_decode($jsonData, true);
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}

		public function getPastDay() {

			if(file_exists($this->josnOfflineFileAddress["PastDay"]) && time() - filemtime($this->josnOfflineFileAddress["PastDay"]) < 2000) {
				$file = fopen($this->josnOfflineFileAddress["PastDay"], "r");
				$jsonData = fread($file, filesize($this->josnOfflineFileAddress["PastDay"]));
				fclose($file);
				if($this->isJson($jsonData)) {
					$this->jsonUpdatedTime['PastDay'] = filemtime($this->josnOfflineFileAddress["PastDay"]);
					return json_decode($jsonData, true);
				}
			}
			$jsonData = null;

			$jsonData = @file_get_contents($this->josnOnlineFileAddress["PastDay"]);
			if($this->isJson($jsonData)) {
				$this->updateData($jsonData, "PastDay");
				$this->jsonUpdatedTime['PastDay'] = time();
				return json_decode($jsonData, true);
			} else {
				if(file_exists($this->josnOfflineFileAddress["PastDay"])) {
					$jsonData = readfile($this->josnOfflineFileAddress["PastDay"]);
					if($this->isJson($jsonData)) {
						$file = fopen($this->josnOfflineFileAddress["PastDay"], "r");
						$jsonData = fread($file, filesize($this->josnOfflineFileAddress["PastDay"]));
						fclose($file);
						return json_decode($jsonData, true);
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}

		public function getPast7Days() {

			if(file_exists($this->josnOfflineFileAddress["Past7Days"]) && time() - filemtime($this->josnOfflineFileAddress["Past7Days"]) < 2000) {
				$file = fopen($this->josnOfflineFileAddress["Past7Days"], "r");
				$jsonData = fread($file, filesize($this->josnOfflineFileAddress["Past7Days"]));
				fclose($file);
				if($this->isJson($jsonData)) {
					$this->jsonUpdatedTime['Past7Days'] = filemtime($this->josnOfflineFileAddress["Past7Days"]);
					return json_decode($jsonData, true);
				}
			}
			$jsonData = null;

			$jsonData = @file_get_contents($this->josnOnlineFileAddress["Past7Days"]);
			if($this->isJson($jsonData)) {
				$this->updateData($jsonData, "Past7Days");
				$this->jsonUpdatedTime['Past7Days'] = time();
				return json_decode($jsonData, true);
			} else {
				if(file_exists($this->josnOfflineFileAddress["Past7Days"])) {
					$file = fopen($this->josnOfflineFileAddress["Past7Days"], "r");
					$jsonData = fread($file, filesize($this->josnOfflineFileAddress["Past7Days"]));
					fclose($file);
					if($this->isJson($jsonData)) {
						$this->jsonUpdatedTime['Past7Days'] = filemtime($this->josnOfflineFileAddress["Past7Days"]);
						return json_decode($jsonData, true);
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}

		public function getPast30Days() {

			if(file_exists($this->josnOfflineFileAddress["Past30Days"]) && time() - filemtime($this->josnOfflineFileAddress["Past30Days"]) < 2000) {
				$file = fopen($this->josnOfflineFileAddress["Past30Days"], "r");
				$jsonData = fread($file, filesize($this->josnOfflineFileAddress["Past30Days"]));
				fclose($file);
				if($this->isJson($jsonData)) {
					$this->jsonUpdatedTime['Past30Days'] = filemtime($this->josnOfflineFileAddress["Past30Days"]);
					return json_decode($jsonData, true);
				}
			}
			$jsonData = null;

			$jsonData = @file_get_contents($this->josnOnlineFileAddress["Past30Days"]);
			if($this->isJson($jsonData)) {
				$this->updateData($jsonData, "Past30Days");
				$this->jsonUpdatedTime['Past30Days'] = time();
				return json_decode($jsonData, true);
			} else {
				if(file_exists($this->josnOfflineFileAddress["Past30Days"])) {
					$file = fopen($this->josnOfflineFileAddress["Past30Days"], "r");
					$jsonData = fread($file, filesize($this->josnOfflineFileAddress["Past30Days"]));
					fclose($file);
					if($this->isJson($jsonData)) {
						$this->jsonUpdatedTime['Past30Days'] = filemtime($this->josnOfflineFileAddress["Past30Days"]);
						return json_decode($jsonData, true);
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}

		public function updateData($jsonData, $label) {
			$file = fopen('cache/' . $label . '.json', 'w');
			fwrite($file, $jsonData);
			fclose($file);
		}
	}

?>