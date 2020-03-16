<?php
    namespace Controller;

    use \Core\AbstractController;
    use \Model\Storage;
    use \Model\Car;

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
    }
?>