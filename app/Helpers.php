<?php
namespace App;

class Helpers {

	/**
	 * Get or set the app token
	 *
	 * @param string|null $newValue
	 * @return void
	 */
	public static function token(string $newValue = null) {
		if( $newValue ) {
			Config::set('token', $newValue);
		}
		$token = Config::get('token');
		return $token;
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
