<?php
    namespace Core;

    use \Config\DB;

    class AbstractController 
    {
        /**
         * Vars for template
         * @var array
         */
        private $params;

        public function __construct()
        {
            $this->params = [];
            $db = new DB();
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
            ob_start();
            require("../Views/" . $template);
            $content = ob_get_clean();
            require("../Views/base.php");
        }
    }
?>