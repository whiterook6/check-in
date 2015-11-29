# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.provider "virtualbox" do |v|
    v.memory = 512
    v.cpus = 1
  end

  config.vm.box = "laravel/homestead"
  config.vm.hostname = "check-in"
  config.vm.network "private_network", ip: "192.168.50.100"
  config.vm.provision :shell, path: './provisions/vagrant.sh'

  config.vm.synced_folder ".", '/var/www',
    group: "www-data",
    mount_options: ['dmode=775', 'fmode=775']
end
