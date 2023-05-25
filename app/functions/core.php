<?php
    function _routeInstance($key, $controller, &$routes) {
        $routes[$key] = [
            'index' => $controller.'/index',
            'edit' => $controller.'/edit',
            'create' => $controller.'/create',
            'delete' => $controller.'/destroy',
            'show'   => $controller .'/show'
        ];
    }

    function _error($data) {
        echo '<pre>';
        print_r($data);
        die();
    }
    function _download_wrap($file_name , $path)
    {
        $path = seal(urlencode($path));

        return _route('attachment:download' , null , [
            'filename' => $file_name,
            'path' => $path
        ]);
    }

    function _download_unwrap($path)
    {
        return urldecode(unseal($path));
    }

    function _errorWithPage( $params = [])
    {
        return die("YOU HAVE SOMERRORS");
    }

    function _requireAuth()
    {
        if(!whoIs()){
            $lastPage = request()->url() ?? 'na';

            Flash::set("You must have an account to access this page." , 'warning');
            return redirect( _route('auth:login', null, [
                'lastPage' => seal($lastPage)
            ]));
        }
    }

    function _route($routeParam , $parameterId = '' , $parameter = [])
    {
        $routeParam = explode(':' , $routeParam);

        $routeKey = '';
        $method  = '';

        if( count($routeParam) > 1) {
            list( $routeKey , $method) = $routeParam;
        }

        $parameterString = '';

        if( !empty($parameterId) )
        {
            if(is_array($parameterId))
            {
                $parameterString .= "?";

                $counter = 0;
                foreach($parameterId as $key => $row) 
                {
                    if( $counter > 0)
                        $parameterString .= "&";

                    $parameterString .= "{$key}={$row}";
                    $counter++;
                }
            }else{
                //parameter is id
                $parameterString = '/'.$parameterId.'?';
            }
        }

        if(is_array($parameter) && !empty($parameter))
        {
            if( empty($parameterString) )
                $parameterString .= '?';
            $counter = 0;
            foreach($parameter as $key => $row) 
            {
                if( $counter > 0)
                    $parameterString .='&';
                $parameterString .= "{$key}={$row}";
                $counter++;
            }
        }

        $routesDeclared = Route::fetchRoutes();

        $routesDeclaredKeys = array_keys($routesDeclared);


        if(!in_array($routeKey , $routesDeclaredKeys)  ){
            echo die("Route {$routeKey} doest not exists");
        }

        $calledRoute = $routesDeclared[$routeKey];

        $calledRouteKeys = array_keys($calledRoute);

        if(!in_array($method, $calledRouteKeys)){
            echo die("Route {$routeKey} doest not have {$method} method does not exist!");
        }
        
        return $calledRoute[$method].$parameterString;
    }

    function _route_link($routeParam , $parameterId = '' , $parameter = []) {
        return URL.'/'._route($routeParam , $parameterId = '' , $parameter = []);
    }

    function _route_call($url,$matchURL,$call) {

        $url = implode('/', $url);

        if(isEqual($url, $matchURL)) {
            $call = explode(':', $call);
            return [
                $call[0],
                $call[1] ?? 'index'
            ];
        }
    }
    

    function _projectActivity($projectId , $message , $href , $createdBy)
    {
        $systemModel = model('SystemMetaModel');

        $system = $systemModel->getInstance();
        
        return $system->store([
            'meta_id' => $projectId,
            'meta_key' => 'PROJECT_NOTIFICATION',
            'value'    => $message,
            'href'     => $href,
            'created_by' => $createdBy
        ]);
    }

    function _user($id)
    {
        $user_model = model('UserModel');

        $user = $user_model->get($id);

        return $user;
    }