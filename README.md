# Pre-installation
It is recommended to have the Firewall / Firewall disabled to avoid installation problems. The Windows firewall does not usually give problems, which does not happen in others such as Kaspersky, Panda, Norton, etc ...
It is necessary to have the following software installed on the machine where you want to deploy:

* [Download VirtualBox](https://www.virtualbox.org/wiki/Downloads)
* [Download Vagrant](https://www.vagrantup.com/downloads.html)
* [Download Git (for Windows)](https://git-scm.com/download/win)
* [Download Git (for Mac)](https://sourceforge.net/projects/git-osx-installer/files/git-2.6.3-intel-universal-mavericks.dmg/download?use_mirror=autoselect)  

_Note: a reboot is required after installing Vagrant._

# Installation on Windows
Inside the `fmrepo` folder that we just cloned, we will find a file called `install.bat`

We double click on said file.

We will select the option `3) virtualbox`.

# Installation on Mac & Linux
Inside the `fmrepo` folder that we just cloned, we will find a file called `install.sh`

* First, through the console, we will go to the `fmrepo` folder

* Then, we will give execute permissions to the file with `chmod +x install.sh`

* Finally, we will execute the file with `sh install.sh`

We will select the option `3) virtualbox`.

# Installation failed?
If the installation fails and you want to try again, make sure to previously delete the created virtual machine. Typically, VirtualBox will own one virtual machine, `homestead`.

* You can list the machines created with the command `vboxmanage list vms`. This will return something like `"homestead" {711af44a-5dab-40ce-a2be-10530f43cc39}`.

* To delete that virtual machine, we will use `vboxmanage unregistervm --delete "homestead"`. It is recommended that VirtualBox is closed.

* We run the installation process described above again.
