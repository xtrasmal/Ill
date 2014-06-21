<?php namespace Ill\System\Modules\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
* List modules
* @author Boris Strahija <bstrahija@gmail.com>
*/
class ModulesCommand extends AbstractCommand {

	/**
	 * Name of the command
	 * @var string
	 */
	protected $name = 'modules';

	/**
	 * Command description
	 * @var string
	 */
	protected $description = 'Just return all registered modules.';

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{
		// Return error if no modules found
		if (count($this->getModules()) == 0)
		{
			return $this->error("Your application doesn't have any registered modules.");
		}
        $this->info('- create migrations command -');
        $this->info('php artisan migrate:make create_users_table --path=app/modules/auth/migrations --table=users --create');
		// Display the modules info
		$this->displayModules($this->getModules());
	}

}
