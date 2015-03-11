Vagrant.configure("2") do |config|
  config.vm.box = "hashicorp/precise32"
  config.vm.network :forwarded_port, host: 5000, guest: 80
  config.vm.network :public_network, ip: "192.168.178.37"

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = 'puppet/manifests'
    puppet.module_path = 'puppet/modules'
    puppet.manifest_file = 'init.pp'
  end
end

