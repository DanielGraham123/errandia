<p style="text-align: center">
<a href="https://errandia.com/" target="_blank">
<img src="https://errandia.com/assets/admin/logo/errandia-logo.png" width="400"></a>
</p>


## About ERRANDIA

Errandia is a platform that allows you search and fine any product, services from the comfort of your home but we you will need to go to the business place to see the product before paying


## Prerequisites

- [Install PHP 8.0 or above](https://linuxhint.com/install-php-8-ubuntu-22-04/)
- [Install Mysql 8.0](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)
- [Install Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
- [Install Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)
- Java 8
- [ElasticSearch 7.x or above](https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.3.0-amd64.deb) or [from apt get](https://www.elastic.co/guide/en/elasticsearch/reference/current/deb.html) 

## Installation

- Open your terminal
- install Java 8 : ``sudo apt install openjdk-8-jre-headless``
- use this link to download the debian package and install Elastic Search : ``https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.3.0-amd64.deb``
- Run the next command to install : ``dpkg -i elasticsearch-7.3.0-amd64.deb``
- from apt get , use the version 7.x
- Paste the following command to clone the project : `git clone https://github.com/nishangsystems/errandia.git`
- Navigate into the project root folder and run `composer install` to install composer packages
- publish this vendor in the next command : `php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"`
- push FCM vendor : `php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config`
- run `php artisan key:generate` to generate an app_key in the .env file
- Connect to MySQL and create the database
- Edit the .env file
- run the next command to generate encryption keys : `php artisan passport:install`


## Running  Errandia locally
 - open your terminal
 - navigate into main directory project 
 - add execution permission to the local_run.sh file :  $ `chmod +x local_run.sh`
 - then run the application : $ `bash local_run.sh`
