<?php

namespace Arvig\ArvigLaravel\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class InstallCommand extends Command
{

    /**
     * The command's signature.
     *
     * @var string
     */
    public $signature = 'arvig-laravel:install';

    /**
     * The command's description.
     *
     * @var string
     */
    public $description = 'Install the Arvig Laravel Scaffold';

    /**
     * Handle the command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Installing Arvig Laravel Package');

        $option = "arvig";

        return (int) ! tap(match ($option) {
            'arvig' => $this->installArvigScaffold(),
            default => $this->invalidOption($option),
        }, function ($installed) use ($option) {
            if ($installed) {
                
            }
        });
    }

    /**
     * Installs the arvig scaffold
     *
     * 
     * @return void
     */    
    public function installArvigScaffold()
    {
        $this->info('Creating Integration Tests Folder');
        $this->createDirectoryIfNotExists(base_path('/tests/Integration'));

        $this->info('Publishing Arvig-Laravel');
        $this->call('vendor:publish', ['--tag' => 'arvig-laravel-publisher', '--force' => true]);

        // If you want to make any additions to .env file
        //$this->updateEnvironmentFile($key,$value);

        $this->info('Arvig Laravel Scaffold installed successfully.');
        
    }
    /**
     * Creates a Directory if it doesn't exist
     * @return void
     */    
    private function createDirectoryIfNotExists($path)
    {
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }
    /**
     * Creates a Directory if it doesn't exist
     * @return void
     */    
    private function moveFile($filepath,$target_dir)
    {
        $filename = basename($filepath);
        $this->createDirectoryIfNotExists($target_dir);
        File::move($path,$target_dir);
    }    
    /**
     * Deletes a Directory if it exists
     * @return void
     */    
    private function deleteDirectoryIfExists($path)
    {
        if(File::isDirectory($path)){
            File::deleteDirectory($path);
        }
    }
    /**
     * Updates the environment file with the given server.
     *
     * @param  string  $server
     * @return void
     */
    public function updateEnvironmentFile($key,$value)
    {
        if (File::exists($env = app()->environmentFile())) {
            $contents = File::get($env);

            if (! Str::contains($contents, $key.'=')) {
                File::append(
                    $env,
                    PHP_EOL.$key.'='.$value.PHP_EOL,
                );
            } else {
                $this->warn('Please adjust the "'.$key.'" environment variable.');
            }
        }
    }

    /**
     * Inform the user that the option type is invalid.
     *
     * @param  string  $option
     * @return bool
     */
    protected function invalidOption(string $option)
    {
        $this->error("Invalid option: {$option}.");

        return false;
    }

}