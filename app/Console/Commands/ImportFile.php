<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FileImportService;

class ImportFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import_file {file_path} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will parse a specific SMARTY_DDF file';

    public function __construct(private FileImportService $fileImportService)
    {
        parent::__construct();
        $this->fileImportService = $fileImportService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pathToFile = $this->argument('file_path');
        $fileId = $this->argument('id');

        try {
            $this->fileImportService->queueImport($pathToFile, $fileId);
            $this->info('File import job has been queued');
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

    }
}
