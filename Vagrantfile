# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"
PIO_PROVISION = "pio-vagrant.sh"
PIO_PROVISION_ARGS = "'vagrant'"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "hashicorp/precise64"

  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--cpuexecutioncap", "90", "--memory", "2048"]
  end

  # install PredictionIO
  config.vm.provision :shell do |s|
    s.path = PIO_PROVISION
    s.args = PIO_PROVISION_ARGS
  end

  config.vm.network "private_network", ip: "192.168.33.20"
end
