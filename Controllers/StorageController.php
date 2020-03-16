<?php
    namespace Controller;

    use \Core\AbstractController;
    use \Model\Storage;
    use \Model\Car;
    use \Core\Helpers;

    class StorageController extends AbstractController
    {
        public function list()
        {
            $storage = new Storage();
            $car = new Car();
            
            $this->renderJson(
                array_map(fn($el) => [
                    'id' => $el['id'], 
                    'car' => $car->findByID($el['car']), 
                    'status' => $storage->getStatus($el['status']),
                    'count' => $el['count'],
                ], $storage->findAll())
            );
        }

        public function detail($id)
        {
            $storages = new Storage();
            $car = new Car();

            $storage = $storages->findByID($id);
            $this->renderJson(
                [
                    'id' => $storage['id'], 
                    'car' => $car->findByID($storage['car']), 
                    'status' => $storages->getStatus($storage['status']),
                    'count' => $storage['count'],
                ]
            );
        }

        public function status($status)
        {
            $storage = new Storage();
            $car = new Car();

            $key = array_search($status, array_column($storage::STATUS, 'slug'));
            $this->renderJson(
                array_map(fn($el) => [
                    'id' => $el['id'], 
                    'car' => $car->findByID($el['car']), 
                    'status' => $storage->getStatus($el['status']),
                    'count' => $el['count'],
                ], $storage->findByStatus($key))
            );
        }

        public function add($request)
        {
            $storage = new Storage();
            foreach($request as $formData){
                $persist[$formData['name']] = $formData['value'];
            }
            if ($persist['car'] && $persist['status'] && $persist['count']){
                $result = $storage->add($persist);
                $this->renderJson(['status' => true, 'data' => $result,]);
            }
            $this->renderJson(['success' => false, 'data' => $request]);
        }

        public function edit($request)
        {
            $storage = new Storage();
            foreach($request as $formData){
                $persist[$formData['name']] = $formData['value'];
            }
            if ($persist['car'] && $persist['status'] && $persist['count']){
                $result = $storage->edit($persist);
                $this->renderJson(['status' => true, 'data' => $result,]);
            }
            $this->renderJson(['success' => false]);
        }

        public function adminList()
        {
            Helpers::checkPermission();

            $storage = new Storage();
            $car = new Car();

            $this->render(
                'Storage/list.php',
                ['storages' => array_map(fn($el) => [
                    'id' => $el['id'], 
                    'car' => $car->findByID($el['car']), 
                    'status' => $storage->getStatus($el['status']),
                    'count' => $el['count'],
                ], $storage->findAll()), ]
            );
        }

        public function adminAdd()
        {
            Helpers::checkPermission('MANAGER_USER');
            $car = new Car();
            $storage = new Storage();
            $this->render(
                'Storage/add.php',
                [
                    'cars' => $car->findAll(),
                    'status' => $storage::STATUS,
                ]
            );
        }

        public function adminEdit($id)
        {
            Helpers::checkPermission('MANAGER_USER');
            $cars = new Car();
            $storage = new Storage();
            $this->render(
                'Storage/edit.php',
                [
                    'cars' => $cars->findAll(),
                    'status' => $storage::STATUS,
                    "storage" => $storage->findByID($id)
                ]
            );
        }
        
        public function adminDelete($id)
        {
            if (Helpers::checkPermission('SUPER_USER')){
                $storage = new Storage();
                $storage->delete((int)$id);
                header("Location: /admin/storage/list");
            }
            
        }
        
    }
?>