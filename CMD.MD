### Stellar Development with Symfony 4
#### 01-02
* composer create-project symfony/skeleton spacebar
* php -S localhost:8000 -t public/
* composer require server
* bin/console server:run
* bin/console
* bin/console debug:autowiring
* bin/console debug:autowiring | grep session
#### 03 
* composer require annotations #sensio/framework-extra-bundle
#### 04
* composer require sec-checker #sensiolabs/security-checker
* git status
* git diff symfony.lock
* bin/console security:check
* composer install
#### 05
* composer require twig #symfony/twig-bundle
#### 06
* ---
#### 07
* composer require profiler --dev #symfony/profiler-pack
#### 08
* composer require debug --dev #symfony/debug-pack
* composer unpack debug
#### 09
* rm -rf var/cache/dev/*
* composer require asset #symfony/asset
#### 10
* bin/console debug:router
#### 11
* ---

