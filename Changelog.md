# Plugin Machine CLI Changelog

## 0.5.7
- Fix path for ZIP file creation
## 0.5.6
- Fixing build automation for releases, so it will have the right version number.
## 0.5.5
- Directory permissions fixes for ZIP file creation
## 0.5.0

- Command to zip plugin for release.
- Load rules based on local path
- Sync rules after login
- Configured log file correctly
- Added a debug command
## 0.4.1

- Log what needs to get added to main plugin file.
- More descriptive errors in CLI output when code API returns error
## 0.4.0
- Write to the right path.
## 0.3.0
- Add self help command
## 0.2.3
- Made API url https
- Fixed bug in API client, was checking wrong status code.
## 0.2.2
- Made compatible with PHP 7.3 and 7.4

## 0.2.1
- Make pluginId arg option for `plugin:config` command.
    - Will use pluginId from pluginMachine.json
