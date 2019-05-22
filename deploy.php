<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'composer-demo-deployer');

// Project repository
set('repository', 'git@github.com:zengenuity/composer-demo.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', [
	'.env',
	'web/sites/default/services.yml',
]);
set('shared_dirs', [
	'web/sites/default/files',
]);

// Writable dirs by web server 
set('writable_dirs', [
	'web/sites/default/files',
]);
set('allow_anonymous_stats', false);

// Hosts

host('dtclass.com')
    ->user('composerdemo')
    ->port(2200)
    ->set('deploy_path', '~/{{application}}');    
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
