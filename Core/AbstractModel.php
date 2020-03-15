<?php
    namespace Core;
    use \Config\DB;

    class AbstractModel
    {
        /**
         * DB table name
         * @var string
         */
        public $tbName;
        
        /**
         * Query builder
         * @var QueryBuilder
         */
        public $qb;

        public function __construct()
        {
            $connection = new DB();
            $this->em = $connection->getDb();
        }

        public function findAll()
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->select('id', 'brand', 'equipment', 'model', 'specifications', 'year')
                ->from('car')
                ->execute()
                ->fetchAll();
        }
    }
?>