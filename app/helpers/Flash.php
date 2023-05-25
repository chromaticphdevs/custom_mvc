<?php 
    class Flash{

        const NAME = 'flash';

        /*
        *['message' , 'type' , 'name']
        */

        public static function setArray($name , $flashMessages = [])
        {
            Session::set('FLASH_ARRAY_'.$name, $flashMessages);
        }   

        public static function showArray($name)
        {
            $flashMessages = Session::get('FLASH_ARRAY_'.$name);
            Session::remove('FLASH_ARRAY_'.$name);

            $html = '';

            foreach($flashMessages as $row) 
            {
                $message = $row['message'];
                $type = isset($row['type']) ? $row['type'] : Flash::randomType();
                $type = empty($type) ? 'primary':$type;

                $html .= <<<EOF
                <div class="alert alert-{$type} alert-dismissible fade show" role="alert">
                    {$message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                </div>
                EOF;
            }

            print $html;
        }


        public static function randomType()
        {
            $type = ['primary' , 'success' , 'warning' , 'danger'];

            return $type[rand(0, 3)];
        }

        public static function set($message = '' , $type ='success' , $key = self::NAME){
            //set flash keyname
            if(Session::check($key)){
                Session::remove($key);
            }
            //set flash classname
            if(Session::check($key.'_class')){
                Session::remove($key.'_class');
            }
    
            Session::set($key ,$message);
            Session::set($key.'_class',$type);
            
        }

        public static function show($name = self::NAME){

            if(Session::check($name) && Session::check($name.'_class')){

                $className = Session::get($name.'_class');
                $message = Session::get($name);

                Session::remove($name); Session::remove($name.'_class');

                print <<< EOF
                 <div class="alert alert-{$className} alert-dismissible fade show" role="alert">
                    {$message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                </div>
                EOF;
            }
        }


    }