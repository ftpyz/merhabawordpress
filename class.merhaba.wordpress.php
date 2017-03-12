<?php
/**
 * Plugin Name: Merhaba Worpress Widget
 * Plugin URI: http://www.fuatpoyraz.com/wordpress-icin-widget-nasil-yapilir
 * Description: Wordpress örnek bileşen
 * Version: 0.2
 * Author: Fuat POYRAZ
 * Author URI: http://www.fuatpoyraz.com
 */
class merhabaWordpress_Widget extends WP_Widget {

    public function __construct() {
        /*
         *  ayarlar yükleniyor. adı,başlık vs
         * */
        parent::__construct(
            'merhabawordpress_widget',
            __( 'Merhaba Wordpress', 'merhabawordpresswidget' ),
            array(
                'classname'   => 'merhabawordpress_widget',
                'description' => __( 'Merhaba Wordpress', 'merhabawordpresswidget' )
            )
        );


    }


    /**
     *  Bileşenler kısmından ihtiyaç olan verileri alıp ön arayüzde gösteriyorum. Burayı istediğiniz gibi dizayn
     * edebilirsiniz. Burası sonuçta backend tarafı burdan istediğim bilgileri alıp frontend göstereceğim
     */
    public function form( $instance ) {

        $title      = esc_attr( $instance['title'] );
        $message    = esc_attr( $instance['message'] );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Başlık:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Örnek Mesaj'); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo $message; ?></textarea>
        </p>

        <?php
    }

    /**
     * widget fonksiyonun çıktısı blog ön yüzünde görüntülenir
     *
     */
    public function widget( $args, $instance ) {

        extract( $args );

        $title      = apply_filters( 'widget_title', $instance['title'] );
        $message    = $instance['message'];

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        echo $message;
        ?>

        <?php echo $after_widget;

    }


    /**
     *  Bileşenler kısmından düzenleme yapılması için
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['message'] = strip_tags( $new_instance['message'] );

        return $instance;

    }

}

/* Widget (bileşin) çalışması için kaydediyorum. */
add_action( 'widgets_init', function(){
    register_widget( 'merhabaWordpress_Widget' ); //class adi
});