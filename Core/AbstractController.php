<?php
    namespace Core;

    use \Config\DB;
    use \Plasticbrain\FlashMessages\FlashMessages;

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

        public function __construct()
        {
            $this->params = [];
            $db = new DB();
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
            ob_start();
            require("../Views/" . $template);
            $content = ob_get_clean();
            require("../Views/base.php");
        }
    }
?>