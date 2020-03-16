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

        public function add($persist)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->insert('storage')
                ->setValue('car', ':car')
                ->setValue('status', ':status')
                ->setValue('count', ':count')
                ->setParameter('car', $persist['car'])
                ->setParameter('status', $persist['status'])
                ->setParameter('count', $persist['count'])
                ->execute();
        }

        public function edit($persist)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->update('storage')
                ->set('car', ':car')
                ->set('status', ':status')
                ->set('count', ':count')
                ->where('id = :id')
                ->setParameter('car', $persist['car'])
                ->setParameter('status', $persist['status'])
                ->setParameter('count', $persist['count'])
                ->setParameter('id', $persist['id'])
                ->execute();
        }

        public function delete($id)
        {
            $qb = $this->em->createQueryBuilder();
            return $qb
                ->delete('storage', 's')
                ->where('s.id = :id')
                ->setParameter('id', $id)
                ->execute();
        }
    }
?>