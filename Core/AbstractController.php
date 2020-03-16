<?php
    namespace Core;

    use \Plasticbrain\FlashMessages\FlashMessages;
    use \Model\User;

    class AbstractController 
    {
        /**
         * Vars for template
         * @var array
         */
        private $params;

        /**
         * @var FlashMessages
         */
        public $msg;

        /**
         * Auth user
         * @var User
         */
        private $user;

        public function __construct()
        {
            $this->params = [];
            $this->user = new User();
            $this->msg = new FlashMessages();
        }

        public function renderJson($response)
        {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response, JSON_PRETTY_PRINT);
            die();
        }

        public function render($template, $params)
        {
            $this->params = array_merge($this->params, $params);
            extract($this->params);
            $flashbag = $this->msg;
            $user = $this->user->isAuth();
            ob_start();
            require("../Views/" . $template);
            $content = ob_get_clean();
            require("../Views/base.php");
        }
    }
?>