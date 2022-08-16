<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:ohanome/platform-api.git');

add('shared_files', [
    '.env.local',
]);
add('shared_dirs', [
    'var/log',
    'var/sessions',
    'var/cache',
    'config/jwt',
]);
add('writable_dirs', []);

// Hosts

host('alpha')
    ->hostname('HOSTNAME') #!
    ->port(22) #!
    ->stage('alpha')
    ->set('deploy_path', 'DEPLOY_PATH') #!
    ->set('branch', 'alpha')
    ->user('USER') #!
    ->set('http_user', 'HTTP_USER') #!
    //->set('bin/php', '/opt/plesk/php/8.1/bin/php')
    ->identityFile('~/.ssh/id_rsa')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no')
;

// Hooks

after('deploy:failed', 'deploy:unlock');
