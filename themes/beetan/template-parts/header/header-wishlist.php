<li>
    <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" class="site-navigation-right__item">
        <span class="material-icons">favorite_border</span>
        <span class="status wishlist_items_count"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></span>
    </a>
</li>