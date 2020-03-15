<?php
    namespace Controller;

    use \Core\AbstractController;
    use \Model\Car;

    class CarController extends AbstractController
    {
        public function list()
        {
            $cars = new Car();
            $this->renderJson(
                $cars->findAll()
            );
        }
    }
?>