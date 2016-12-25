<?php

// 移除令人迷惑的管理工具条站点链接
add_action( 'wp_before_admin_bar_render', 'mu_remove_admin_bar' );
function mu_remove_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'my-sites' );
}


// 获取站点信息
function mu_get_site_info( $blog_id, $name ) {
    return get_blog_option( $blog_id, $name, true );
}

// 显示站点信息
function mu_site_info( $blog_id, $name ) {
    echo mu_get_site_info( $blog_id, $name );
}

// 自定义站点列表，显示在每个站点中
function all_sites() { ?>
    <div class="pure-g row">

        <?php
        // WP_Site_Query arguments
        $args = [
            'public'  => '1',
            'order'   => 'ASC',
            'orderby' => 'id',
        ];

        // The Site Query
        $site_query = new WP_Site_Query( $args );

        // The Loop
        if ( $site_query ) { ?>
            <h2>
                <a target="_blank" class="button button-primary" href="/wp-admin/network/site-new.php">添加站点</a>
                <a target="_blank" class="button" href="/wp-admin/network/sites.php">所有站点</a>
            </h2>
            <?php foreach ( $site_query->sites as $site ) { ?>
                <div class="pure-u-1 pure-u-md-1-3 sep">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h2><?php mu_site_info( $site->blog_id, 'blogname' ); ?></h2>
                                <h4 class="card-title">
                                    <a target="_blank" href="<?php mu_site_info( $site->blog_id, 'siteurl' ); ?>">
                                        浏览站点
                                    </a> |

                                    <a target="_blank" href="<?php mu_site_info( $site->blog_id, 'siteurl' ); ?>/wp-admin">
                                        仪表盘
                                    </a> |

                                    <a target="_blank" href="/wp-admin/network/site-info.php?id=<?php echo $site->blog_id;?>">
                                        编辑站点
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        }
        ?>
    </div>
<?php }

/**
 * Register a custom menu page.
 */
function enter_mu_all_sites() {
    add_menu_page( 'redirecting', '站点', 'read', 'all-sites', 'all_sites', 'dashicons-admin-multisite', 0 );
}

add_action( 'admin_menu', 'enter_mu_all_sites' );