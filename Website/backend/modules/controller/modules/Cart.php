<?php


class Cart {
    private function createCart(){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
    }


    public function edit(Request $request, Response $response, $productIdField, $quantityField){
        if($response->isSuccess()){

            $this->createCart();

            $productId = $response->getData($productIdField);

            $quantity = $request->getData($quantityField);
            $quantityAvailable = $response->getData($quantityField);

            if($quantityAvailable - $quantity < 0){
                $response->setResponseContent('INVALID_REQUEST_DATA', [$quantityField]);
                return $response;
            }

            $data = $response->getData(null);
            $data[$quantityField] = $quantity;

            $_SESSION['cart'][$productId] = $data;
            $response->setResponseContent('SUCCESS', null, $_SESSION['cart']);
        }
        return $response;
    }


    public function delete(Request $request, $productIdField){
        $productId = $request->getData($productIdField);

        $this->createCart();

        if(isset($_SESSION['cart'][$productId])){
            unset($_SESSION['cart'][$productId]);
        }

        $response = new Response();
        $response->setResponseContent('', null, $_SESSION['cart']);

        return $response;
    }


    private function join(Request $request, Response $response){

    }


    public function list(){
        $this->createCart();

        $response = new Response();
        $response->setResponseContent('', null, $_SESSION['cart']);

        return $response;
    }
}