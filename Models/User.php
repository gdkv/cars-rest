<?php
    namespace Model;

    use Core\AbstractModel;

    class User extends AbstractModel
    {
        public $tbName = 'users';

        public function findByLogin($login)
        {
            $qb = $this->em->createQueryBuilder();

            return $qb
                ->select('*')
                ->from('users', 'u')
                ->where('u.login = :login')
                ->setParameter('login', $login)
                ->execute()
                ->fetch();
        }

    }
?>