<?php
function example_init() {
    $moduleName = 'example';
    $assetsDistPath = get_template_directory_uri() . '/dist';
    $assetsFilePath = 'modules/' . $moduleName . '/' . $moduleName;
    $viewFile = get_template_directory() . '/resources/modules/' . $moduleName . '/' . $moduleName . '.view.php';
    $controllerFile = get_template_directory() . '/resources/modules/' . $moduleName . '/' . $moduleName . '.controller.php';
    $modelFile = get_template_directory() . '/resources/modules/' . $moduleName . '/' . $moduleName . '.model.php';

    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name'              => $moduleName,
            'title'             => __('REPLACE_TITLE', 'TEXTDOMAIN'),
            'description'       => __('REPLACE_DESCRIPTION', 'TEXTDOMAIN'),
            'render_callback'   => 'example_block_render_callback',
            'category'          => 'formatting',
            'icon'              => 'icon',
            'keywords'          => array($moduleName, __('REPLACE_TITLE', 'TEXTDOMAIN')),
            'align'             => 'full',
            'supports'          => array(
                'multiple' => true,
				'mode' => false,
				'jsx' => true
            ),
            'render_template'   => $viewFile,
            //'enqueue_script'    => $assetsDistPath . '/js/' . $assetsFilePath . '.min.js',
            'enqueue_style'     => $assetsDistPath . '/css/' . $assetsFilePath . '.min.css',
            'controller_file'   => $controllerFile,
            'model_file'   => $modelFile,
        ));
    }
}

function example_block_render_callback($block) {
    if (file_exists($block['render_template'])) {
        require_once($block['controller_file']);
        require($block['model_file']);
        require($block['render_template']);
    }
}

add_action('acf/init', 'example_init');

/********************************/
// Save and load plugin specific ACF field groups via the /acf-json folder.
/********************************/

// Save
function example_acf_json_saving($group) {
    // list of field groups that should be saved to my-plugin/acf-json
    $groups = ""; //array('group_605ddb2646ffd');

    if (in_array($group['key'], $groups)) {
        add_filter('acf/settings/save_json', function() {
            return dirname(__FILE__) . '/acf-json';
        });
    }
}

add_action('acf/update_field_group', 'example_acf_json_saving', 1, 1);