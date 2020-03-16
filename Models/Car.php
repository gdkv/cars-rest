<?php
    namespace Model;
    
    use Core\AbstractModel;

    class Car extends AbstractModel
    {
        public $tbName = 'car';

        public function add($persist)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->insert('car')
                ->setValue('brand', ':brand')
                ->setValue('model', ':model')
                ->setValue('year', ':year')
                ->setValue('equipment', ':equipment')
                ->setValue('specifications', ':specifications')
                ->setParameter('brand', $persist['brand'])
                ->setParameter('model', $persist['model'])
                ->setParameter('year', $persist['year'])
                ->setParameter('equipment', $persist['equipment'])
                ->setParameter('specifications', $persist['specifications'])
                ->execute();
        }

        public function edit($persist)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->update('car')
                ->set('brand', ':brand')
                ->set('model', ':model')
                ->set('year', ':year')
                ->set('equipment', ':equipment')
                ->set('specifications', ':specifications')
                ->where('id = :id')
                ->setParameter('brand', $persist['brand'])
                ->setParameter('model', $persist['model'])
                ->setParameter('year', $persist['year'])
                ->setParameter('equipment', $persist['equipment'])
                ->setParameter('specifications', $persist['specifications'])
                ->setParameter('id', $persist['id'])
                ->execute();
        }

        public function delete($id)
        {
            $qb = $this->em->createQueryBuilder();
            return $qb
                ->delete('car', 'c')
                ->where('c.id = :id')
                ->setParameter('id', $id)
                ->execute();
        }
    }
?>