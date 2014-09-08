Machine Learning with PHP and Prediction.io
===========================================

> TV show recommendation engine built in PHP using [Prediction.io](http://prediction.io).

Talk at ViennaPHP on 8 September 2014 by [Florian Eckerstorfer](https://florian.ec). You can find the [slides of this presentation](https://speakerdeck.com/florianeckerstorfer/machine-learning-with-predictionio-and-php) on Speakerdeck.


Installation
------------

**Requirements**

- [Vagrant](http://www.vagrantup.com) (If you're not familiar with Vagrant, consult the [Getting Started](http://docs.vagrantup.com/v2/getting-started/index.html) guide)
- [VirtualBox](https://www.virtualbox.org)

First you need to checkout this repository:

```shell
$ git clone https://github.com/florianeckerstorfer/viennaphp-predictionio
```

Start the virtual machine:

```shell
$ vagrant up
```

SSH into the virtual machine and create an admin user (follow the instructions):

```shell
$ vagrant ssh
$ /opt/PredictionIO/bin/users
```

You can now access the Prediction.io admin GUI at [http://192.168.33.20:9000](http://192.168.33.20:9000) and login using the credentials you defined earlier.

Next you should create an application named `viennaphp-tvshow` and add an *Item Recommendation Engine* named `itemrec`.

You can stop the virtual machine by typing `vagrant halt` and no data will be lost. If you want to restart the virtual machine you need to use `vagrant up --provision`. If you destroy the machine you need to set it up again later (creating the user, application and so on) and all data is lost.

Further information about running Prediction.io using Vagrant exists in the [Installing Prediction.io with Vagrant (VirtualBox)](http://docs.prediction.io/current/installation/install-predictionio-with-virtualbox-vagrant.html) guide.

If Prediction.io works you can start the application.

```shell
$ vagrant ssh
$ cd /vagrant/web
$ php -S 192.168.33.20:3000
```

You should no be able to access the web application using [http://192.168.33.20:3000](http://192.168.33.20:3000).


Dependencies
------------

- [Silex](http://silex.sensiolabs.org)
- [Twig](http://twig.sensiolabs.org)
- [PredictionIO PHP SDK](https://github.com/PredictionIO/PredictionIO-PHP-SDK)
