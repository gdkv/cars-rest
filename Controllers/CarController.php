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
                array_map(fn($el) => [
                    'id' => $el['id'], 
                    'brand' => $el['brand'], 
                    'model' => $el['model'],
                    'specifications' => json_decode($el['specifications'], true),
                    'equipment' => $el['equipment'],
                    'year' => $el['year'],
                ], $cars->findAll())
            );
        }

        public function add($request)
        {
            $cars = new Car();
            foreach($request as $formData){
                $persist[$formData['name']] = $formData['value'];
            }
            if ($persist['brand'] && $persist['model'] && $persist['equipment']  && $persist['year']){
                $result = $cars->add($persist);
                $this->renderJson(['success' => true, 'data' => $result,]);
            }
            $this->renderJson(['success' => false]);
        }

        public function edit($request)
        {
            $cars = new Car();
            foreach($request as $formData){
                $persist[$formData['name']] = $formData['value'];
            }
            if ($persist['brand'] && $persist['model'] && $persist['equipment']  && $persist['year']){
                $result = $cars->edit($persist);
                $this->renderJson(['success' => true, 'data' => $result,]);
            }
            $this->renderJson(['success' => false]);
        }

        public function adminList()
        {
            $cars = new Car();
            $this->render(
                'Car/list.php',
                ['cars' => array_map(fn($el) => [
                    'id' => $el['id'], 
                    'brand' => $el['brand'], 
                    'model' => $el['model'],
                    'specifications' => json_decode($el['specifications'], true),
                    'equipment' => $el['equipment'],
                    'year' => $el['year'],
                ], $cars->findAll()), ]
            );
        }
        public function adminAdd()
        {
            $this->render(
                'Car/add.php',
                []
            );
        }
        public function adminEdit($id)
        {
            $cars = new Car();
            $this->render(
                'Car/edit.php',
                ["car" => $cars->findByID($id)]
            );
        }
        public function adminDelete($id)
        {
            $cars = new Car();
            $cars->delete((int)$id);
            header("Location: /admin/cars/list");
        }
    }
?>