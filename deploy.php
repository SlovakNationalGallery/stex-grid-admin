<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:SlovakNationalGallery/stex-grid-admin.git');
set('bin/npm', 'n --offline exec 20 npm');
set('bin/php', 'php8.2');
set('bin/composer', '{{bin/php}} {{deploy_path}}/.dep/composer.phar');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('webumenia.sk')
    ->set('remote_user', 'lab_sng')
    ->set('deploy_path', '/var/www/stex.sng.sk');

// Tasks

task('build', function () {
    cd('{{release_path}}');
    run('{{bin/npm}} ci');
    run('{{bin/npm}} run build');
});

// Hooks

after('deploy:vendors', 'build');
after('deploy:failed', 'deploy:unlock');

