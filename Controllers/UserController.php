<?php
    namespace Controller;

    use \Core\AbstractController;
    use \Model\User;
    use \Firebase\JWT\JWT;
    use \Core\Helpers;

    class UserController extends AbstractController
    {
        public function list()
        {
            $cars = new User();
            $this->renderJson(
                $cars->findAll()
            );
        }

        public function login($login, $password)
        {
            $user = new User();
            $user_data = $user->findByLogin($login);
            if (isset($user_data) && password_verify($password, $user_data['password']) ){
                $jwt = JWT::encode(
                    Helpers::generateTokenData($user_data['id'], $user_data['login']), 
                    Helpers::SECRET_KEY
                );
                setcookie("jwt", $jwt, time()+24*60*60, "/");
                $this->renderJson(
                    [
                        'status' => 'Login success',
                        'jwt' => $jwt,
                    ]
                );
               
            } else {
                http_response_code(401);
                $this->renderJson(['status' => 'Login failed',]);
            }
        }

        public function isAuth($jwt="")
        {
            if($jwt || isset($_COOKIE['jwt'])) {
                try {
                    $jwt = ($jwt ? $jwt : $_COOKIE['jwt']);
                    $user = new User();
                    $decoded = JWT::decode($jwt, Helpers::SECRET_KEY, ['HS256']);
                    return $user->findByID($decoded->data->userID);
                }
                catch (\Exception $e){
                    return false;
                }
            }
            return false;
        }
    }
?>