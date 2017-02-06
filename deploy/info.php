<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'rstudio';
$app['version'] = '1.0.1';
$app['release'] = '1';
$app['vendor'] = 'Marc Laporte';
$app['packager'] = 'eGloo';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('rstudio_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('rstudio_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = 'Statistics';

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['rstudio']['title'] = $app['name'];
$app['controllers']['settings']['title'] = lang('base_settings');
$app['controllers']['policy']['title'] = lang('base_app_policy');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

// Note: *-devel dependencies are for building "plotly" via the
// RStudio plugin system.
$app['core_requires'] = array(
    'app-rstudio-plugin-core',
    'app-accounts-core',
    'rstudio-server',
    'java',
    'R',
    'openssl-devel',
    'libcurl-devel',
);

$app['core_directory_manifest'] = array(
    '/etc/clearos/rstudio.d' => array(),
    '/var/clearos/rstudio' => array(),
    '/var/clearos/rstudio/backup' => array(),
);

$app['core_file_manifest'] = array(
    'rstudio-server.php'=> array('target' => '/var/clearos/base/daemon/rstudio-server.php'),
    'rstudio.conf' => array('target' => '/usr/clearos/sandbox/etc/httpd/conf.d/rstudio.conf'),
    'authorize' => array(
        'target' => '/etc/clearos/rstudio.d/authorize',
        'mode' => '0644',
        'owner' => 'root',
        'group' => 'root',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
);

$app['delete_dependency'] = array(
    'app-rstudio-core',
    'app-rstudio-plugin-core',
    'rstudio',
);
