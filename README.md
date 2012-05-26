# Symfony skeleton

## Installation

    PROJECT_NAME=symfony-skeleton
    GIT_URL=git@github.com:rithis/symfony-skeleton.git
    git clone git://github.com/rithis/symfony-skeleton.git $PROJECT_NAME
    cd $PROJECT_NAME
    git remote set-url origin $GIT_URL
    git remote add symfony-skeleton git://github.com/rithis/symfony-skeleton.git
    cp app/config/parameters.dist.yml app/config/parameters.yml
    composer.phar install
    ./app/console assets:install --symlink web
