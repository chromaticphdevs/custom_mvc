    <nav class="sidebar">
    <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
        <?php echo COMPANY_NAME?>
        <div style="width: 30px; display:inline-block"><img src="<?php echo _path_upload_get('main/logo_main.png') ?>" alt="" style="width:100%"></div>
    </a>
    <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
    </div>
    </div>
    <div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
            <a href="<?php echo _route('dashboard:index')?>" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>
        <?php if(isEqual(whoIs('user_type'), ['ADMINISTRATOR', 'SUB_ADMIN'])) :?>
        <li class="nav-item">
            <a href="<?php echo _route('user:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Users</span>
            </a>
        </li>
        <?php endif?>

        <li class="nav-item">
            <a href="<?php echo _route('item:create')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Upload Catalog</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo _route('item:my-catalog')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">My Catalog</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo _route('item:catalogs')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Catalogs</span>
            </a>
        </li>

        <?php if(isEqual(whoIs('user_type'), ['ADMINISTRATOR', 'SUB_ADMIN'])) :?>
            <li class="nav-item">
                <a href="<?php echo _route('category:index')?>" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo _route('catalog-log:index')?>" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Logs And Archived</span>
                </a>
            </li>
        <?php endif?>

        <li class="nav-item">
            <a href="<?php echo _route('item:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Catalog Search</span>
            </a>
        </li>
    </ul>
    </div>
</nav>