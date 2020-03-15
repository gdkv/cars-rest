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
    

        static public function generateTokenData($login)
        {
            $user = new User();
            $user_data = $user->findByLogin($login);

            $tokenId = base64_encode(random_bytes(32));
            $issuedAt = time();
            $notBefore = $issuedAt + 10;
            $expire = $notBefore + 60;
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
                    'userID'   => $user_data['id'],
                    'userLogin' => $user_data['login'], 
                ]
            ];
        }
        
    }
?>