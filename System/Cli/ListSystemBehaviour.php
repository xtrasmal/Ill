<?php namespace Ill\System\Cli;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use File;

class ListSystemBehaviour extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'system:behaviour';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Shows a list of the system behaviours.';

    /**
     * Create a new command instance.
     *
     * @return \Ill\System\Cli\ListSystemBehaviour
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->info('==== Your application is capable of ====');
        // Get table helper
        $this->table = $this->getHelperSet()->get('table');
        print_r($this->file_get_php_classes(app_path()));

        var_export($this->whoImplements('Ill\Core\BehaviourPool\Interfaces\BehaviourPool'));
//        foreach (get_declared_classes() as $className) {
//            if (in_array('BehaviourPool', class_implements($className))) {
//                echo $className, PHP_EOL;
//                $this->info($className);
//            }
//        }
	}
    public function file_get_php_classes($filepath) {
        $files = File::allFiles($filepath);
        foreach ($files as $file)
        {
            echo (string)$file, "\n";
        }

    }

    public function whoImplements($interface_name) {
        if (interface_exists($interface_name)) {
            return array_filter(get_declared_classes(), create_function('$className', "return in_array(\"$interface_name\", class_implements(\"\$className\"));"));
        }
        else {
            return null;
        }
    }
	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
//	protected function getArguments()
//	{
//		return array(
//			array('example', InputArgument::REQUIRED, 'An example argument.'),
//		);
//	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
