<?php
	class Router{
		protected $_controller, $_action, $_view, $_params, $_route;

		public function __construct($_route){
			$this->_route = $_route;
			$this->_controller = 'Controller';
			$this->_action = 'index';
			$this->_params = array();
			$this->_view  =  false; // The init view
		}

		private function parseRoute(){
			$id = false;
			//parse path info
			if(isset($this->_route)){
				//the request path
				$path = $this->_route;
				//the rules to route
              	$cai =  '/^([\w]+)\/([\w]+)\/([\d]+).*$/';  //  controller/action/id
              	$ci =   '/^([\w]+)\/([\d]+).*$/';           //  controller/id
              	$ca =   '/^([\w]+)\/([\w]+).*$/';           //  controller/action
              	$c =    '/^([\w]+).*$/';                    //  action
              	$i =    '/^([\d]+).*$/';                    //  id
				//Initialize the matches
				$matches = array();
				//If this is home page route
				if(empty($path)){
					$this->_controller = 'index';
					$this->_action = 'index';
				}elseif(preg_match($cai, $path, $matches)){
					$this->_controller = $matches[1];
                  	$this->_action = $matches[2];
                  	$id = $matches[3];
				}else if (preg_match($ci, $path, $matches)){
                  	$this->_controller = $matches[1];
                  	$id = $matches[2];
              	} else if (preg_match($ca, $path, $matches)){
                  	$this->_controller = $matches[1];
                  	$this->_action = $matches[2];
              	} else if (preg_match($c, $path, $matches)){
                	$this->_controller = $matches[1];
                  	$this->_action = 'index';    
              	} else if (preg_match($i, $path, $matches)){
                  	$id = $matches[1];
              	}

				//Get query string from url
				$query = array();
				$parse = parse_url($path);
				//If we have query string
				if(!empty($parse['query'])){
					//parse query string
					parse_str($parse['query'],$query);
					//If query paramater is parsed
					if(!empty($query)){
						//Merge the query paramater to $_GET variable
						$_GET = array_merge($_GET, $query);
						//Merge the query paramater to $_REQUEST variable
						$_REQUEST = array_merge($_REQUEST, $query);
					}
				}
			}
			
			//Gets the request method
			$method = $_SERVER["RE"]
		}

	}
