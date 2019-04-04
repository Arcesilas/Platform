# Platform

Want to know where is User's home directory without needing to check if your script is running on a Unix-like or Windows OS? Want to know where you can store some configuration file or data? This package is for you!

> Notice: This is a work in progress and help is welcome to make this tool reliable accross platforms.

## Installation

```bash
composer require arcesilas/platform
```

## Usage

Main available methods:

```php
// Is the script running on a Windows OS
Platform::isWindows(); // returns a boolean

// Get user's home directory
Platform::getUserHome(); // example: /home/johndoe or C:\Users\johnd

// Get a directory to store data
Platform::getDataDir(); // example: /home/johndoe/.local/share or C:\Users\johnd\AppData\Local

// Get a directory to store configuration files
// On windows, defaults to user's home
Plateform::getConfigDir(); // example: /home/johndoe/.config

// Get a directory to store configuration
// On Windows, defaults to user's home
Plateform::getCacheDir(); // example: /home/johndoe/.cache
```

## References

* [Windows KNOWNFOLDERID constants](https://docs.microsoft.com/fr-fr/windows/desktop/shell/knownfolderid)
* [Freedesktop specification](https://specifications.freedesktop.org/basedir-spec/basedir-spec-latest.html)
* Composer source code:
    - [Composer\Factory class](https://github.com/composer/composer/blob/master/src/Composer/Factory.php)
    - [Composer\Util\Platform class](https://github.com/composer/composer/blob/master/src/Composer/Util/Platform.php)
* [Windows environment variables](https://en.wikipedia.org/wiki/Environment_variable#Windows)
