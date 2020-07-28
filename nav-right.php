<?php
    $menu_class = get_nav_menu_locations();
    $header_menu_id = $menu_class['header'];
    $header_menus = wp_get_nav_menu_items($header_menu_id);

    function get_child_menu_item($menu_array, $parent_id) {
        $child_menu = [];

        if (!empty($menu_array) && is_array($menu_array)) {
            foreach ($menu_array as $menu) {
                if (intval($menu->menu_item_parent) === $parent_id) {
                    array_push($child_menu, $menu);
                }
            }
        }

        return $child_menu;
    }
?>

<header class="fl-page-header fl-page-header-primary<?php FLTheme::header_classes(); ?>"<?php FLTheme::header_data_attrs(); ?><?php FLTheme::print_schema( ' itemscope="itemscope" itemtype="https://schema.org/WPHeader"' ); ?>  role="banner">
    <div class="fl-page-header-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="fl-page-header-logo"<?php echo FLTheme::print_schema( ' itemscope="itemscope" itemtype="https://schema.org/Organization"' ); ?>>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php FLTheme::logo(); ?></a>
		                <?php echo FLTheme::get_tagline(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="eurizen-custom-menu">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="main_nav">

                                <?php if (!empty($header_menus) && is_array($header_menus)): ?>

                                <ul class="navbar-nav">
                                    <?php
                                      foreach ($header_menus as $menu_item) {
                                          if (!$menu_item->menu_item_parent) {
	                                          $child_menu_items = get_child_menu_item($header_menus, $menu_item->ID);
	                                          $has_children = !empty($child_menu_items) && is_array($child_menu_items);
	                                          if (!$has_children) {
	                                              ?>
                                                    <li class="nav-item"> <a class="nav-link" href="<?php echo esc_url($menu_item->url);?>"> <?php echo esc_html($menu_item->title);?> </a> </li>
                                                  <?php
                                              } else {
	                                              ?>
                                                  <li class="nav-item dropdown">
                                                      <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url);?>" data-toggle="dropdown">  <?php echo esc_html($menu_item->title);?>  </a>
                                                      <ul class="dropdown-menu">
                                                          <?php
                                                            foreach ($child_menu_items as $child_menu){
	                                                            $cchild_menu_items = get_child_menu_item($header_menus, $child_menu->ID);
	                                                            $has_children = !empty($cchild_menu_items) && is_array($cchild_menu_items);

	                                                            if (!$has_children) {
		                                                            ?>
                                                                        <li><a class="dropdown-item" href="<?php echo esc_url($child_menu->url)?>"> <?php echo esc_html($child_menu->title)?> </a></li>
                                                                    <?php
	                                                            } else {
		                                                            ?>
                                                                    <li><a class="dropdown-item" href="<?php echo esc_url($child_menu->url)?>"> <?php echo esc_html($child_menu->title);?> </a>
                                                                        <ul class="submenu dropdown-menu">
                                                                            <?php foreach ($cchild_menu_items as $cchild_menu_item) :?>
                                                                            <li><a class="dropdown-item" href="<?php echo esc_url($cchild_menu_item->url)?>"> <?php echo esc_html($cchild_menu_item->title)?></a></li>
                                                                            <?php endforeach;?>
                                                                        </ul>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                          ?>
                                                      </ul>
                                                  </li>
                                                  <?php
	                                          }
                                          }
                                      }
                                    ?>

                                </ul>

                                <?php
                                    endif;
                                ?>

                            </div>
                            <!-- navbar-collapse.// -->
                        </nav>
                    </div>
                </div>
                <div class="col-md-2">
                    <?php FLTheme::nav_search();?>
                </div>
            </div>
        </div>
    </div>
</header>
