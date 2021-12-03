# PHP CLI For Plugin Machine

- [Documentation](https://pluginmachine.com/cli)

[![PHP Tests](https://github.com/imaginarymachines/plugin-machine-php-cli/actions/workflows/php-test.yml/badge.svg)](https://github.com/imaginarymachines/plugin-machine-php-cli/actions/workflows/php-test.yml)
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
