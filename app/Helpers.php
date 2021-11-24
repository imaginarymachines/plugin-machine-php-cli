<?php
namespace App;
use Storage;
class Helpers {

	/**
	 * Get or set the app token
	 *
	 * @param string|null $newValue If null. The default, return set value.
	 * @return string
	 */
	public static function token(string $newValue = null) {
		if( $newValue ) {
			Config::set('token', $newValue);
		}
        if( env('PLUGIN_MACHINE_TOKEN' )){
            return env('PLUGIN_MACHINE_TOKEN');
        }
		$token = Config::get('token');
		return (string)$token;
	}

    /**
	 * Get or set the app api URL
	 *
	 * @param string|null $newValue If null. The default, return set value.
	 * @return string
	 */
    public static function apiUrl(string $newValue = null){
        if( $newValue ) {
			Config::set('token', $newValue);
		}
        return env('PLUGIN_MACHINE_URL',Config::get('apiUrl','http://localhost') );
    }
    /**
     * Get or set the pluginMachine.json
     *
     * @param array|null $newValue If null. The default, return set value.
	 * @return array
    */
    public static function pluginConfig(array $newValue = null){
        if( $newValue ) {
            return Storage::put( 'pluginMachine.json', $newValue);
        }
        if( ! Storage::exists('pluginMachine.json')){
            return [];
        }
        return json_decode(Storage::get('pluginMachine.json'),true);
    }
	 /**
     * Get the home directory for the user.
     *
     * @return string
     */
    public static function home()
    {
        return $_SERVER['HOME'] ?? $_SERVER['USERPROFILE'];
    }

	  /**
     * Get the file size in kilobytes.
     *
     * @param  string  $file
     * @return string
     */
    public static function kilobytes($file)
    {
        return round(filesize($file) / 1024, 2).'KB';
    }

	/**
     * Get the file size in megabytes.
     *
     * @param  string  $file
     * @return string
     */
    public static function megabytes($file)
    {
        return round(filesize($file) / 1024 / 1024, 2).'MB';
    }

	/**
     * Get or set configuration values.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public static function config($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $innerKey => $value) {
                Config::set($innerKey, $value);
            }

            return;
        }

        return Config::get($key, $value);
    }

}
