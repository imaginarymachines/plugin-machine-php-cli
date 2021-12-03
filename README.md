# PHP CLI For Plugin Machine

- [Documentation](https://pluginmachine.com/cli)

[![PHP Tests](https://github.com/imaginarymachines/plugin-machine-php-cli/actions/workflows/php-test.yml/badge.svg)](https://github.com/imaginarymachines/plugin-machine-php-cli/actions/workflows/php-test.yml)
[![Latest Stable Version](http://poser.pugx.org/imaginary-machines/plugin-machine-php-cli/v)](https://packagist.org/packages/imaginary-machines/plugin-machine-php-cli) [![Total Downloads](http://poser.pugx.org/imaginary-machines/plugin-machine-php-cli/downloads)](https://packagist.org/packages/imaginary-machines/plugin-machine-php-cli) [![Latest Unstable Version](http://poser.pugx.org/imaginary-machines/plugin-machine-php-cli/v/unstable)](https://packagist.org/packages/imaginary-machines/plugin-machine-php-cli) [![License](http://poser.pugx.org/imaginary-machines/plugin-machine-php-cli/license)](https://packagist.org/packages/imaginary-machines/plugin-machine-php-cli) [![PHP Version Require](http://poser.pugx.org/imaginary-machines/plugin-machine-php-cli/require/php)](https://packagist.org/packages/imaginary-machines/plugin-machine-php-cli)

## Install
```bash
composer global require imaginary-machines/plugin-machine-php-cli:dev-main -W
```

### Requires

- [Composer 2.0 or later]()
- [PHP 7.3 or later]()

## Usage

- Check version
	- `plugin-machine version`
- Test that it can write a file
	- `plugin-machine file:put`
- Login to plugin machine.
	- `plugin-machine login {token}`
    - [When logged in, go to /dashboard/user](https://pluginmachine.app/dashboard/user) to see API token.
- Write pluginMachine.json for a plugin
    - `php plugin-machine plugin:config {pluginId}`
- Add a feature to current plugin
    - `php plugin-machine add`

### Envioronment Variables

- `PLUGIN_MACHINE_TOKEN` - Authentication token. Overrides values set with login command.
- `PLUGIN_MACHINE_WRITE_PATH` - The path to write output to.

### Uninstall

```bash
composer global remove imaginary-machines/plugin-machine-php-cli
```

## Development

- Build
	-`php plugin-machine app:build plugin-machine`
- Test
	-`php plugin-machine test`
- Sync Rules
	-`php plugin-machine sync`
- Lint code
    - `composer lint`
    - `composer fix`
- Check for minimum version PHP compatibility.
    - `composer compat`
- Check for other PHP version compatibility:
    - `composer compat:version 8.0`
