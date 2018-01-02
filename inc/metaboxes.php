<?php
function pine_perfil_metabox() {

    $perfil_metabox = new Odin_Metabox(
        'perfil_metabox', // Slug/ID of the Metabox (Required)
        'Galeria de Fotos do Perfil', // Metabox name (Required)
        'perfil', // Slug of Post Type (Optional)
        'normal', // Context (options: normal, advanced, or side) (Optional)
        'high' // Priority (options: high, core, default or low) (Optional)
    );

    $perfil_metabox->set_fields(
        array(
            // Image Plupload field.
            array(
                'id'          => 'perfil_metabox_images', // Required
                'label'       => __( 'Imagens', 'pine' ), // Required
                'type'        => 'image_plupload', // Required
            ),
        )
    );
}

add_action( 'init', 'pine_perfil_metabox', 1 );