#!/bin/bash

function install-module-if-not-exists {
	if [ `sudo puppet module list | grep $1-$2 | wc -l` -eq 0 ]; then 
		sudo puppet module install $1/$2
	fi
}

install-module-if-not-exists puppetlabs apache
install-module-if-not-exists puppetlabs mysql
install-module-if-not-exists jfryman nginx
install-module-if-not-exists thias php
install-module-if-not-exists maestrodev jetty
install-module-if-not-exists saz timezone