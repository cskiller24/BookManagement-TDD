<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\FileSystem as UtilsFileSystem;

final class ImagesDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all images in storage folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->confirm('This will delete all the images. Do you wish to continue?')) {
            $files = array_filter(glob(public_path('storage/images/*')), function ($file) {
                return false === strpos($file, 'default_image.png');
            });

            $file = new Filesystem();

            if ($file->delete($files)) {
                $this->info('Images Deleted Successfully');
            } else {
                $this->error('Something went wrong, please try again');
            }
        }
        return 0;
    }
}