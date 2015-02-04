<?php namespace Bocapa\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->package('bocapa/users');

        \Event::listen('menu.generate', function()
        {
            $menu_options = [
                'ul' => ['class' => 'treeview-menu'],
                'text-prepend' => '<i class="fa fa-users"></i>',
                'text-append' => '<i class="fa fa-angle-left pull-right"></i>',
                'li' => ['class' => 'treeview']
            ];

            $manage_options = [
                'a' => [
                    'route' => 'users.adminBrowse',
                    'style' => 'margin-left: 2px;'
                ],
                'text-prepend' => '<i class="fa fa-angle-double-right"></i>'
            ];

            $edit_user_options = [
                    'a' => [
                            'route' => 'users.adminEdit'
                    ],
                    'hidden' => true
            ];

            if($menu = \Menu::exists('backend')) {
                $content = $menu->addItem('Users', $menu_options);
                $users = $content->addItem('Manage', $manage_options);
                $users->addItem('Edit User', $edit_user_options);
            }
        });
	}

    public function boot()
    {
        include __DIR__.'/../../routes.php';
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
