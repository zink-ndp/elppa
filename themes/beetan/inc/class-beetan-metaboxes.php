<?php

class Beetan_Metaboxes {
	public function __construct() {
		add_action( 'load-post.php', array( $this, 'init' ) );
		add_action( 'load-post-new.php', array( $this, 'init' ) );
	}

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
	}

	public function add_meta_box( $post_type ) {
		if ( in_array( $post_type, [ 'attachment', 'product' ] ) ) {
			return;
		}

		$types = get_post_types( array(
			'public' => true,
		) );

		if ( ! in_array( $post_type, $types ) ) {
			return;
		}

		switch ( $post_type ) {
			case 'post':
				$title = esc_html__( 'Post Options', 'beetan' );
				break;

			case 'page':
				$title = esc_html__( 'Page Options', 'beetan' );
				break;
		}

		$title = apply_filters( 'beetan_metabox_title', $title, $post_type );

		// Add page metabox
		add_meta_box( 'beetan_metabox', $title, array( $this, 'render_meta_box_content' ), $types, 'side', 'low' );
	}

	public function save_meta_box( $post_id ) {
		if ( ! isset( $_POST['beetan_meta_box_nonce'] ) ) {
			return $post_id;
		}

		if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['beetan_meta_box_nonce'] ) ), 'beetan_meta_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}

		// Hide title
		$hide_title = ( isset( $_POST['beetan_hide_title'] ) && '1' === $_POST['beetan_hide_title'] ) ? 1 : 0;

		update_post_meta( $post_id, 'beetan_hide_title', $hide_title );
	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'beetan_meta_box', 'beetan_meta_box_nonce' );

		$hide_title = get_post_meta( $post->ID, 'beetan_hide_title', true );
		?>
        <label>
            <input type="checkbox"
                   name="beetan_hide_title"
                   value="1" <?php checked( $hide_title, 1 ); ?> />
			<?php printf( esc_html__( 'Hide %s title', 'beetan' ), esc_html( $post->post_type ) ); // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment ?>
        </label>
		<?php
	}
}

new Beetan_Metaboxes();
