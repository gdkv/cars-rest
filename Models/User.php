<?php
    namespace Model;

    use Core\AbstractModel;
    use \Firebase\JWT\JWT;
    use \Core\Helpers;

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

        public function isAuth($jwt="")
        {
            if($jwt || isset($_COOKIE['jwt'])) {
                try {
                    $jwt = ($jwt ? $jwt : $_COOKIE['jwt']);
                    $decoded = JWT::decode($jwt, Helpers::SECRET_KEY, ['HS256']);
                    return $this->findByID($decoded->data->userID);
                }
                catch (\Exception $e){
                    return false;
                }
            }
            return false;
        }
    }
?>