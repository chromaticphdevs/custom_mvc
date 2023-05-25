<?php   

    function wLogo($type = 'main', $size = ['height' => '70', 'width' => '70']) {
        $source = URL.DS.'uploads/main/';
        if($type == 'main') {
            $source = $source.= 'logo_main.png';
            return <<<EOF
                <div>
                    <img src= '{$source}' style='height:{$size['height']}px;width:{$size['width']}px'/>
                </div>
            EOF;
        } else {
            $source = $source.= 'logo_wide.jpg';
            return <<<EOF
                <div>
                    <img src= '{$source}' style='width:100%'/>
                </div>
            EOF;
        }
    }
    

    function btnCreate( $route  , $text = 'Create', $attributes  = null)
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-xs" {$attributes}><i class='fa fa-plus'> </i> {$text} </a>
        EOF;
    }
    
    function btnView( $route  , $text = 'Show', $attributes  = null)
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-xs" {$attributes}><i class='fa fa-eye'> </i> {$text} </a>
        EOF;
    }

    function btnEdit( $route  , $text = 'Edit', $attributes  = null )
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-xs" {$attributes}><i class='fa fa-edit'> </i> {$text}  </a>
        EOF;
    }

    function btnDelete( $route  , $text = 'Delete', $attributes  = null )
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="form-verify btn btn-danger btn-xs" {$attributes}><i class='fa fa-trash'> </i> {$text} </a>
        EOF;
    }

    function btnList( $route  , $text = 'List', $attributes  = null )
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-xs" {$attributes}><i class='fa fa-list'> </i> {$text}  </a>
        EOF;
    }

    /*
    *ancors
    *['url' , 'icon' , 'text']
    */
    function anchorList( $anchors = [])
    {
        $token = random_letter(12);

        $html  = <<<EOF
        <div class="dropdown mb-2">
        <button class="btn p-0" type="button" id="dropdownMenuButton-{$token}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{$token}">
        EOF;

        foreach($anchors as $anchor)
        {
            $html .= <<<EOF
            <a class="dropdown-item d-flex align-items-center" href="{$anchor['url']}">
                <i data-feather="{$anchor['icon']}" class="icon-sm me-2"></i> 
            <span class="">{$anchor['text']}</span></a>
            EOF;
        }

        $html.= <<<EOF
            </div>
        </div>
        EOF;

        return $html;
    }

    function anchor( $route , $type = 'edit' , $text = null , $color = null)
    {
        $icon = 'edit';
        $a_text = 'Edit';
        $a_color = 'primary';

        switch($type)
        {
            case 'delete':
                $icon = 'trash';
                $a_text = 'Delete';
            break;
            case 'edit':
                $icon = 'edit';
                $a_text = 'Edit';
            break;

            case 'view':
                $icon = 'eye';
                $a_text = 'Show';
            break;

            case 'create':
                $icon = 'plus';
                $a_text = 'Create';
            break;

            default:
                $icon = 'fa-check-circle';
        }

        if( !is_null($text) )
            $a_text = $text;

        if( !is_null($color) )
            $a_color = 'danger';

        return <<<EOF
            <a href="{$route}" class='text-{$a_color}'><i class='fa fa-{$icon}'> </i> {$a_text}  </a>
        EOF;
    }


    function divider()
    {
        print <<<EOF
            <div style='margin:30px 0px'>
            </div>
        EOF;
    }

    function wReturnLink( $route )
    {
        print <<<EOF
            <a href="{$route}">
                <i class="feather icon-corner-up-left"></i> Return
            </a>
        EOF;
    }

    function wLinkDefault($link , $text = 'Edit' , $attributes = [])
	{	
        //for noble
		$icon = isset($attributes['icon']) ? "<i data-feather='{$attributes['icon']}' style='width:15px'></i>" : "<i data-feather='arrow-left-circle' style='width:15px'></i>";
        if(isset($attributes['icon'])) {
            unset($attributes['icon']);
        }
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);
		return <<<EOF
			<a href="{$link}" style="text-decoration:underline" {$attributes}>{$icon} {$text}</a>
		EOF;
	}

    function wWrapSpan($text)
    {
        $retVal = '';
        
        if(is_array($text))
        {
            foreach($text as $key => $t) 
            {
                if( $key > 3 )
                    $classHide = '';
                $retVal .= "<span class='badge badge-primary badge-classic'> {$t} </span>";
            }
        }else{
            $retVal = "<span class='badge badge-primary badge-classic'> {$text} </span>";
        }

        return $retVal;
    }

    

    function wDivider($size = '30')
    {
        return <<<EOF
            <div style="margin-top:{$size}px"> </div>
        EOF;
    }

    function wCatalogToStringToLink($tagString, $linkBase = '', $searchKey = '') {
        $tagArray = explode(',', $tagString);
        $html = '';
        foreach($tagArray as $key => $row) {
            if($key > 0)
                $html .= ", ";

            if($searchKey == 'tags') {
                $row = trim($row);
                $url ="{$linkBase}?keyword={$row}";
                $html .= <<<EOF
                    <a href ='{$url}'>#{$row}</a>
                EOF;
            } else {
                $html .= <<<EOF
                    <a href ='{$linkBase}/?searchBy={$searchKey}&keyword={$row}'>{$row}</a>
                EOF;
            }
        }
        
        echo $html;
    }