<?php
$moduleName = str_replace('acf/', '', $block['name']).'-module';
$moduleModel = array(
    /********************************/
    // Section default acf fields
    /********************************/

    // Module data
    'module-name' => $moduleName,
    /********************************/

    // Generate unique class to overwrite default stylings
    'unique-class' => $moduleName.'__'.bin2hex(random_bytes(12)),
    /********************************/

    /********************************/
    // Module specific acf fields
    /********************************/
);