<?php


abstract class BaseComponent {
    protected function redirect(Request $request, $component){
        $response = new Response();
        if(isset($component) && method_exists($component, $request->getAction())){
            $action = $request->getAction();
            $response = $component->$action($request);
            if(method_exists($component, 'commit')){
                $component->commit();
            }
        }
        else{
            $response->setResponseContent('INVALID_REQUEST');
        }
        return $response;
    }


    protected function getComponent($name, $type){
        $class_name = $name . $type;
        $type = strtolower($type);
        require_once __DIR__ . "/../../$type/$class_name.php";
        return new $class_name($name);
    }
}