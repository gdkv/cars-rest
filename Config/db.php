<?php
    namespace Config;
    use Doctrine\DBAL\DriverManager;
    use Doctrine\Common\Cache\ArrayCache;

    class DB 
    {
        /**
         * @var $db current database connection
         */
        private $db;

        public $cache;

        public function __construct()
        {
            $this->db = null;
            $this->cache = new ArrayCache();
        }

        /**
         * Get current database connection
         * @return $db
         */ 
        public function getDb()
        {

            $connectionParams = [
                'url' => 'postgresql://car_user:car123pass@127.0.0.1:5432/car_rest',
            ];
            
            $this->db = DriverManager::getConnection($connectionParams);
            
            return $this->db;
        }
    }
?>