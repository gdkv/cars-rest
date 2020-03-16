<?php
    namespace Model;
    
    use Core\AbstractModel;

    class Storage extends AbstractModel
    {
        const STATUS = [
            ['id' => 1, 'title' => 'на складе', 'slug' => 'onstock'],
            ['id' => 2, 'title' => 'продано', 'slug' => 'sold'],
            ['id' => 3, 'title' => 'ожидаем поступления', 'slug' => 'expected'],
        ];
        public $tbName = 'storage';

        public function getStatus($id)
        {
            $key = array_search($id, array_column(self::STATUS, 'id'));
            return self::STATUS[$key]['title'];
        }

        public function findByStatus($id)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->select('*')
                ->from('storage', 's')
                ->where('s.status = :status')
                ->setParameter('status', self::STATUS[$id]['id'])
                ->execute()
                ->fetchAll();
        }
    }
?>