# EV PIU

Vagrant Box con la Plataforma de Información Unificada para CI Estrada Velasquez.

## Prerequisitos

### Requerido

Se asume que se tienen VirtualBox y Vagrant instalados. De lo contrario, tome la última versión de cada uno de los siguientes enlaces.

* [Virtual Box y Virtual Box Extension Pack](https://www.virtualbox.org/wiki/Downloads)
* [Vagrant](https://www.vagrantup.com/downloads.html)

### Recomendado

Una vez que Vagrant esté instalado, es muy recomendable que se instale el siguiente complemento Vagrant:

* [vagrant-hostupdater](https://github.com/cogitatio/vagrant-hostsupdater)

  ```bash
  vagrant plugin install vagrant-hostsupdater
  ```

---

## ¿Qué incluye?

* Ubuntu 16.04.3 LTS
* Apache
* MariaDB
* PHP 7.0
* Composer
* PHPUnit
* phpMyAdmin
* Microsoft ODBC y PHP Drivers

---

## Instalación

La primera vez que se clone el repositorio y se descargue la box, puede tomar varios minutos...

```bash
git clone https://github.com/msarboleda/ev-piu.git
cd ev-piu && vagrant up
```

Cuando Vagrant termine, ahora está listo y se puede verificar que PHP está trabajando en:

[http://ev-piu.local/](http://ev-piu.local/).

* phpMyAdmin: [http://ev-piu.local/phpmyadmin](http://ev-piu.local/phpmyadmin)
  * Usuario predeterminado:       phpmyadmin
  * Contraseña predeterminada:    root
