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

        public function login($request=null)
        {
            if (is_array($request) && count($request)){
                foreach($request as $formData){
                    $form[$formData['name']] = $formData['value'];
                }
            }
            if ($form['login'] && $form['password']){
                $user = new User();
                $user_data = $user->findByLogin($form['login']);
                if (isset($user_data) && password_verify($form['password'], $user_data['password']) ){
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
            } else {
                $this->render('Auth/login.php', []);
            }
        }

        public function logout($request=null)
        {
            Helpers::removeTokenData();
        }

    }
?>