class mysql {

  package { ['mysql-server']:
    ensure => present,
    require => Exec['apt-get update'],
  }

  service { 'mysql':
    ensure  => running,
    require => Package['mysql-server'],
  }

  file { '/etc/mysql/my.cnf':
    source  => 'puppet:///modules/mysql/my.cnf',
    require => Package['mysql-server'],
    notify  => Service['mysql'],
  }

  exec { 'set-mysql-password':
    unless  => 'mysqladmin -uroot -proot password root',
    command => 'mysqladmin -uroot password root',
    path    => ['/bin', '/usr/bin'],
    require => Service['mysql'],
  }

  file { '/tmp/install.sql':
    source  => 'puppet:///modules/mysql/install.sql',
    require => Exec["set-mysql-password"],
  }


  exec { 'import mysql':
    path  => '/usr/bin:/usr/sbin',
    command => 'mysql -u root -proot  < /tmp/install.sql',
    logoutput => on_failure, 
    require =>  file['/tmp/install.sql'],
  }
}
