### Symfony 4 Fundamentals: Services, Config & Environments
#### 01
* bin/console debug:autowiring
#### 02
* composer require knplabs/knp-markdown-bundle
* bin/console debug:autowiring | grep markdown
#### 03
* bin/console debug:autowiring | grep cache
#### 04
* bin/console config:dump KnpMarkdownBundle
* bin/console cache:clear
* bin/console config:dump TwigBundle
* bin/console config:dump twig
