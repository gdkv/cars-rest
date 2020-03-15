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
                    Helpers::generateTokenData($user_data['login'], $user_data['password']), 
                    Helpers::SECRET_KEY
                );
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
    }
?>