Raspberry Pi Control Panel
=========

The Raspberry Pi Control Panel is designed to give you a fast overview of your Raspberry Pi.

It was originally programmed to fit my needs, so if you need something else, you are free to add it yourself. I use it on RaspBMC,
i haven't testet it, but it should work on all other Raspbian/Debian based distributions.

Localizations can be created by adding files to
```
./localization/langugage.lang.php
```

and editing *index.php* by changing

```
define(LANGUAGE, "english");
```
to your languagefile.

**Preview:**

![alt tag](http://i.imgur.com/kxLWoH7.png)

Tech
-----------

Raspberry Pi Control Panel includes some libraries. Libraries used are:

* [JustGage] - JavaScript library for the gauges.
* [Raphaël] - JavaScript library for vector graphics. Needed by JustGage.

Installation
--------------

You need to have a Webserver up and running on your Raspberry Pi. lighttpd, Apache2 have been testet, but i think others will do just fine. You need to have PHP enabled and be able to execute *shell_exec()* commmands.

For the reboot and shutdown buttons to work, you need to adjust your /etc/sudoers file by using
```sh
sudo visudo
```
and adding this line
```sh
www-data ALL=NOPASSWD:/sbin/shutdown
```
**WARNING:**
*After adding this line, the User www-data is able to restart and shutdown your Pi. Which means, anybody who might get access to your Pi over http could do so also. You need to secure it yourself. If your Pi is running in your local network, and there is nobody around who might shut down your Pi on purpose, this solution works fine without extra securing it.*

License
----

nada - do whatever you want. This was made quick and dirty, what means that this solution might work for me, but not for you. You may fork, rename, distribute, or do whatever you want, as long as you don't blame me for things getting broken or not working the way the should.

[JustGage]:http://justgage.com/
[Raphaël]:http://raphaeljs.com/



