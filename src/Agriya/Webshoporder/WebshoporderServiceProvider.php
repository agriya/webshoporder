<?php namespace Agriya\Webshoporder;

use Illuminate\Support\ServiceProvider;

class WebshoporderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('agriya/webshoporder');
		//include __DIR__.'/../../filters.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['webshoporder'] = $this->app->share(function($app)
		{
			return new Webshoporder;
		});
		$this->app->booting(function()
		{
		  	$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		  	$loader->alias('Webshoporder', 'Agriya\Webshoporder\Facades\Webshoporder');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
