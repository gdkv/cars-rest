<?php
    namespace Core;
    use \Config\DB;
    use \Doctrine\DBAL\Cache\QueryCacheProfile;
    use \Doctrine\DBAL\FetchMode;

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

        public $dbCache;

        public function __construct()
        {
            $connection = new DB();
            $this->em = $connection->getDb();
            $this->dbCache = $connection->cache;
        }

        public function findAll()
        {
            $qb = $this->em->createQueryBuilder();
            $cacheID = $this->tbName . "_list";

            $config = $this->em->getConfiguration();
            $config->setResultCacheImpl($this->dbCache);

            $qb
                ->select('*')
                ->from($this->tbName);
                // ->execute()
                // ->fetchAll();
            $stmt = $this->em->executeCacheQuery(
                $qb->getSql(), 
                [], 
                [], 
                new QueryCacheProfile(120, $cacheID)
            );
            $data = $stmt->fetchAll();
            $stmt->closeCursor(); // at this point the result is cached

            // $data = $this->dbCache->fetch($cacheID);

            return $data;
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