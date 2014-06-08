package { 'vim':
	ensure => present
}

class {'apache':
	package_ensure => 'present',
	mpm_module => 'prefork',
	default_vhost =>false,
}

file {['/www', '/www/phpaspnetmvc']:
	ensure=>'directory',
	owner =>'root',
	group=>'root',
	before => Class['apache']
}

file { '/www/phpaspnetmvc/application':
	ensure	=> 'link',
	target =>'/phpaspnetmvc.git',
	before => Class['apache'],
	require => File['/www/phpaspnetmvc']
}

file { '/www/phpaspnetmvc/logs': 
	ensure=>'directory',
	owner=>'www-data',
	group=>'www-data',
	require=> File['/www/phpaspnetmvc'],
}

file {'/var/log/apache2/error.log':
	owner => 'www-data',
	group => 'www-data',
}


class  {'apache::mod::php':}
class  {'apache::mod::rewrite':}
class  {'apache::mod::expires':}
class  {'apache::mod::headers':}

php::ini {'/etc/php5/cli-php.ini':
}

php::ini {'/etc/php5/apache2/php.ini':
	display_errors => 'On',
	
	notify => Class['apache::service'],
}

php::module{'xdebug':}

# php::module::ini{'xdebug':
# 	settings=>{
# 		'xdebug.remote_enable' => 1,
# 		'xdebug.remote_host' => "10.0.2.2",
# 		'xdebug.remote_port' => 9000,
# 		'xdebug.remote_handler' => "dbgp",
# 		'xdebug.remote_mode' => 'req',
# 		'xdebug.remote_connect_back' => 0, # we don't use connect back because xdebug uses $_SERVER['REMOTE_ADDR'] which doesn't work with nginx
# 		'xdebug.idekey' => "sublime.xdebug"
# 	},
# 	require=>Php::Module['xdebug'],
# 	notify=>Class['apache::service']
# }


# exec {'patch xdebug.ini':
# 	cwd =>'/etc/php5/apache2/conf.d',
# 	path=>'/bin:/usr/bin',
# 	command => 'patch < /vagrant/patches/xdebug.patch',
# 	require=> Php::Module::Ini['xdebug'],
# 	unless=>'grep zend_extension 20-xdebug.ini',
# 	notify=>Class['apache::service']
# }


apache::vhost { 'phpaspnetmvc':
	ip => '192.168.56.153',
	port => 80,
	docroot => '/www/phpaspnetmvc/application/webroot',
	docroot_group=>'vagrant',
	error_log_file => 'error.log',
	access_log_file => 'access.log',
	logroot =>'/www/phpaspnetmvc/logs',
	setenv => [
		'APPLICATION_ENV dev'
	],
	override => 'all',

}

class {'nginx':
	confd_purge => true,
	vhost_purge => true,
	require => [Class['apache'], Apache::Vhost['phpaspnetmvc']]
}

nginx::resource::vhost {'phpaspnetmvc':
	proxy => 'http://192.168.56.153:80',
	listen_ip => '192.168.56.151',
	listen_port => 80,
	location_cfg_append => {
		'proxy_set_header' => 'Host $host',
		'sendfile' => 'off'
	}
}

php::module { ['mysql']:
	notify => Class['apache::service']
}

class { '::mysql::server':
	root_password => 'freek',
	old_root_password => 'root'
}

user { 'vagrant':
	ensure => 'present',
	shell => '/bin/bash'
}

class{'timezone':
	timezone => 'Europe/Amsterdam'
}
