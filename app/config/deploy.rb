set :application, "symfony-skeleton"
set :domain, "#{application}.com"
set :deploy_to, "/var/www/#{domain}"

set :repository, "git@github.com:rithis/#{domain}.git"
set :scm, :git

role :web, domain
role :app, domain
role :db, domain, :primary => true

set :shared_files, ["app/config/parameters.yml"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]

set :user, "www-data"
set :use_sudo, false
set :keep_releases, 5
set :update_vendors, true
