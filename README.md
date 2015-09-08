# SMS Server

-------

SMS Server was written using [Rémy Sanchez](http://www.phpclasses.org/browse/author/428373.html) code from [PHP Classes](http://www.phpclasses.org/browse/file/17926.html). It was asked me to write a fully functionable SMS Server using the minimum resources possible, for a POC (prove of concept).

### What we need

* **USB 3G Modem**: I use a ZTE MF636 3G USB Modem
* **Web Server running windows**: I use WAMP for this POC.

I've made very little changes on  [Rémy Sanchez](http://www.phpclasses.org/browse/author/428373.html) code.

Changes on php_serial-class.php
-------

```php
//Line 497
elseif ($this->_os === "windows")
{
$content = "";
$content = fgets($this->_dHandle);
$content .= fgets($this->_dHandle);
return $content;
}
...
//Line 508
function readSMS ($count = 0)
{
$content = "";
$content = fgets($this->_dHandle);
$content .= fgets($this->_dHandle);
$content .= fgets($this->_dHandle);
$content .= fgets($this->_dHandle);
$content .= fgets($this->_dHandle);
$content .= fgets($this->_dHandle);
return $content;
}
```

How to use
--------------------
* **Install the drivers for USB 3G Modem**
* **Disable autorun on USB 3G Modem**: You can do it with PuTTY.
* **Change COM Port:**:line 8 of sms.php file.
* **Explore AT-commands**: That's not require but helps a lot [link](http://www.engineersgarage.com/tutorials/at-commands#)

License
------------------
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.