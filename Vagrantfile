Vagrant.configure("2") do |config|
  config.ssh.private_key_path = '~/.vagrant.d/insecure_private_key'
  config.ssh.insert_key = false
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.network "forwarded_port", guest: 80, host: 80
end