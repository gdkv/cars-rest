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
                ->select('*')
                ->from($this->tbName)
                ->execute()
                ->fetchAll();
        }

        public function findByID($id)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->select('*')
                ->from($this->tbName, 't')
                ->where('t.id = :id')
                ->setParameter('id', $id)
                ->execute()
                ->fetch();
        }
    }
?>