<?php
// application
require_once APP_DIR . 'app_controller.php';
require_once APP_DIR . 'app_model.php';
require_once APP_DIR . 'app_layout_view.php';
require_once APP_DIR . 'app_exception.php';

// vendor
require_once VENDOR_DIR . 'SimpleDBI/SimpleDBI.php';
require_once VENDOR_DIR . 'Pagerfanta/Adapter/AdapterInterface.php';
require_once VENDOR_DIR . 'Pagerfanta/Adapter/ArrayAdapter.php';

require_once VENDOR_DIR . 'Pagerfanta/View/ViewInterface.php';
require_once VENDOR_DIR . 'Pagerfanta/View/DefaultView.php';

require_once VENDOR_DIR . 'Pagerfanta/View/Template/TemplateInterface.php';
require_once VENDOR_DIR . 'Pagerfanta/View/Template/Template.php';
require_once VENDOR_DIR . 'Pagerfanta/View/Template/DefaultTemplate.php';

require_once VENDOR_DIR . 'Pagerfanta/PagerfantaInterface.php';
require_once VENDOR_DIR . 'Pagerfanta/Pagerfanta.php';

// lib
require_once LIB_DIR . 'log.php';
require_once LIB_DIR . 'router.php';
require_once LIB_DIR . 'database.php';

// helpers
require_once HELPERS_DIR . 'html_helper.php';
require_once HELPERS_DIR . 'validation_helper.php';

spl_autoload_register(
    function ($name) {
        $filename = Inflector::underscore($name) . '.php';
        if (strpos($name, 'Controller') !== false) {
            require CONTROLLERS_DIR . $filename;
        } else {
            if (file_exists(MODELS_DIR . $filename)) {
                require MODELS_DIR . $filename;
            }
        }
    }
);
