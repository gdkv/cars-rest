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
                ['GET', '/cars/list', ['CarController', 'list']],
                ['POST', '/cars/add', ['CarController', 'add']],
                ['POST', '/cars/edit', ['CarController', 'edit']],
                ['POST', '/cars/delete', ['CarController', 'delete']],
                ['GET', '/storage/list', ['StorageController', 'list']],
                ['GET', '/storage/status/{status}', ['StorageController', 'status']],
                ['POST', '/user/login', ['UserController', 'login']],
                // ['POST', '/user/isauth', ['UserController', 'isAuth']],
                // ADMIN URLS
                ['GET', '/admin/cars/list', ['CarController', 'adminList']],
                ['GET', '/admin/cars/add', ['CarController', 'adminAdd']],
                ['GET', '/admin/cars/edit/{id:\d+}', ['CarController', 'adminEdit']],
                ['GET', '/admin/cars/delete/{id:\d+}', ['CarController', 'adminDelete']],
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