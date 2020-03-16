<?php
    namespace Core;
    use Model\User;

    /**
     * полезные в проекте функции
     */
    class Helpers 
    {
        const SECRET_KEY = 'super_secret_key';

        static public function siteURL()
        {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domainName = $_SERVER['HTTP_HOST'];
            return $protocol.$domainName;
        }
    

        static public function generateTokenData($id, $login)
        {
            $tokenId = base64_encode(random_bytes(32));
            $issuedAt = time();
            $notBefore = $issuedAt;
            $expire = $notBefore + 24 * 60 * 60;
            $serverName = self::siteURL(); 
            /*
            * Create the token as an array
            */
            return [
                'iat'  => $issuedAt,
                'jti'  => $tokenId,
                'iss'  => $serverName,
                'nbf'  => $notBefore,
                'exp'  => $expire,
                'data' => [
                    'userID'   => $id,
                    'userLogin' => $login, 
                ]
            ];
        }

        static public function checkPermission($level='USER')
        {
            $user = new User();
            if ($user_data = $user->isAuth()){
                $user_level = $user_data['role'];
                switch ($level) {
                    case 'SUPER_USER':
                        if ($user_level === 'SUPER_USER') {
                            return true;
                        }
                        break;
                    case 'MANAGER_USER':
                        if ($user_level === 'MANAGER_USER' || $user_level === 'SUPER_USER') {
                            return true;
                        }
                        break;
                    default:
                        return true;
                        break;
                }
            }
            http_response_code(401);
            header('Location: /admin/login');
        }

        static public function removeTokenData()
        {
            if (isset($_COOKIE['jwt'])) {
                unset($_COOKIE['jwt']); 
                setcookie('jwt', null, -1, '/'); 
            } 
            header('Location: /admin/login');
        }
        
    }
?>