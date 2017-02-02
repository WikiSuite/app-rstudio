
Name: app-rstudio
Epoch: 1
Version: 1.0.0
Release: 1%{dist}
Summary: RStudio Server
License: GPLv3
Group: ClearOS/Apps
Packager: eGloo
Vendor: Marc Laporte
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base

%description
RStudio is an integrated development environment (IDE) for R. It includes a console, syntax-highlighting editor that supports direct code execution, as well as tools for plotting, history, debugging and workspace management.

%package core
Summary: RStudio Server - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: rstudio-server
Requires: java

%description core
RStudio is an integrated development environment (IDE) for R. It includes a console, syntax-highlighting editor that supports direct code execution, as well as tools for plotting, history, debugging and workspace management.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/rstudio
cp -r * %{buildroot}/usr/clearos/apps/rstudio/

install -d -m 0755 %{buildroot}/etc/clearos/rstudio.d
install -d -m 0755 %{buildroot}/var/clearos/rstudio
install -d -m 0755 %{buildroot}/var/clearos/rstudio/backup
install -D -m 0644 packaging/authorize %{buildroot}/etc/clearos/rstudio.d/authorize
install -D -m 0644 packaging/rstudio-server.php %{buildroot}/var/clearos/base/daemon/rstudio-server.php

%post
logger -p local6.notice -t installer 'app-rstudio - installing'

%post core
logger -p local6.notice -t installer 'app-rstudio-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/rstudio/deploy/install ] && /usr/clearos/apps/rstudio/deploy/install
fi

[ -x /usr/clearos/apps/rstudio/deploy/upgrade ] && /usr/clearos/apps/rstudio/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-rstudio - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-rstudio-core - uninstalling'
    [ -x /usr/clearos/apps/rstudio/deploy/uninstall ] && /usr/clearos/apps/rstudio/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/rstudio/controllers
/usr/clearos/apps/rstudio/htdocs
/usr/clearos/apps/rstudio/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/rstudio/packaging
%dir /usr/clearos/apps/rstudio
%dir /etc/clearos/rstudio.d
%dir /var/clearos/rstudio
%dir /var/clearos/rstudio/backup
/usr/clearos/apps/rstudio/deploy
/usr/clearos/apps/rstudio/language
/usr/clearos/apps/rstudio/libraries
%config(noreplace) /etc/clearos/rstudio.d/authorize
/var/clearos/base/daemon/rstudio-server.php
