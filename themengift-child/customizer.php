<?php
function tmg_child_customize_register( $wp_customize ) {
    
    // Add Homepage Sections Panel
    $wp_customize->add_panel( 'tmg_homepage_panel', array(
        'title'       => __( 'Homepage Sections', 'themengift' ),
        'description' => 'Customize homepage images and texts.',
        'priority'    => 30,
    ) );

    // Shop By Recipient Section
    $wp_customize->add_section( 'tmg_recipient_section', array(
        'title'    => __( 'Shop By Recipient', 'themengift' ),
        'panel'    => 'tmg_homepage_panel',
    ) );

    $recipients = array('1' => 'For Her', '2' => 'For Him', '3' => 'For Couples', '4' => 'For Kids');
    
    foreach($recipients as $id => $label) {
        $wp_customize->add_setting( 'tmg_recipient_img_'.$id, array(
            'default'   => '',
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tmg_recipient_img_'.$id, array(
            'label'    => sprintf(__( '%s Image', 'themengift' ), $label),
            'section'  => 'tmg_recipient_section',
            'settings' => 'tmg_recipient_img_'.$id,
        ) ) );
        
        $wp_customize->add_setting( 'tmg_recipient_link_'.$id, array(
            'default'   => '#',
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( 'tmg_recipient_link_'.$id, array(
            'label'    => sprintf(__( '%s Link', 'themengift' ), $label),
            'section'  => 'tmg_recipient_section',
            'type'     => 'url',
        ) );
    }

    // Corporate Banner Section
    $wp_customize->add_section( 'tmg_corporate_section', array(
        'title'    => __( 'Corporate Gifting', 'themengift' ),
        'panel'    => 'tmg_homepage_panel',
    ) );

    $wp_customize->add_setting( 'tmg_corporate_bg_img', array('default' => '') );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tmg_corporate_bg_img', array(
        'label'    => __( 'Background Image', 'themengift' ),
        'section'  => 'tmg_corporate_section',
    ) ) );

    // Hero Slider Section
    $wp_customize->add_section( 'tmg_hero_section', array(
        'title'    => __( 'Hero Slider Images', 'themengift' ),
        'panel'    => 'tmg_homepage_panel',
    ) );

    for( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( 'tmg_hero_img_'.$i, array( 'default' => '' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tmg_hero_img_'.$i, array(
            'label'   => sprintf( __( 'Slide %d Background Image', 'themengift' ), $i ),
            'section' => 'tmg_hero_section',
        ) ) );
    }

    // Smart Tags Section
    $wp_customize->add_section( 'tmg_smart_tags_section', array(
        'title'    => __( 'Smart Tags Section', 'themengift' ),
        'panel'    => 'tmg_homepage_panel',
    ) );

    $wp_customize->add_setting( 'tmg_smart_tag_img', array( 'default' => '' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tmg_smart_tag_img', array(
        'label'   => __( 'Smart Tag Feature Image', 'themengift' ),
        'section' => 'tmg_smart_tags_section',
    ) ) );


    // Add more sections here later if needed
}
add_action( 'customize_register', 'tmg_child_customize_register' );
