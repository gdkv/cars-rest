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
                ['POST', '/storage/add', ['StorageController', 'add']],
                ['POST', '/storage/edit', ['StorageController', 'edit']],
                ['POST', '/storage/delete', ['StorageController', 'delete']],
                ['GET', '/storage/list', ['StorageController', 'list']],
                ['GET', '/storage/status/{status}', ['StorageController', 'status']],
                ['POST', '/user/login', ['UserController', 'login']],
                // ADMIN URLS
                ['GET', '/admin/login', ['UserController', 'login']],
                ['GET', '/admin/logout', ['UserController', 'logout']],
                ['GET', '/admin/cars/list', ['CarController', 'adminList']],
                ['GET', '/admin/cars/add', ['CarController', 'adminAdd']],
                ['GET', '/admin/cars/edit/{id:\d+}', ['CarController', 'adminEdit']],
                ['GET', '/admin/cars/delete/{id:\d+}', ['CarController', 'adminDelete']],
                ['GET', '/admin/storage/list', ['StorageController', 'adminList']],
                ['GET', '/admin/storage/add', ['StorageController', 'adminAdd']],
                ['GET', '/admin/storage/edit/{id:\d+}', ['StorageController', 'adminEdit']],
                ['GET', '/admin/storage/delete/{id:\d+}', ['StorageController', 'adminDelete']],
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