<?php

    namespace Config;

    class URLs {

        private $urls;

        public function __construct()
        {
            /**
             * URLs array
             * Method, URI, array(Controller name, Controller method)
             */
            $this->urls = [
                ['GET', '/test', ['UserController', 'list']],
                ['POST', '/user/login', ['UserController', 'login']],
            ];
            // yaml_parse_file()
        }
        

        /**
         * Get the value of urls
         */ 
        public function getUrls()
        {
            return $this->urls;
        }
    }
    
?>