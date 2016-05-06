<?php

namespace Garrinar\Filesystem\Distributed\Commands;


use Illuminate\Database\Schema\Blueprint;
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 06.05.2016
 * Time: 20:05
 */
class CreateFilesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DistrFD:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create files table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('real_name');
            $table->string('name');
            $table->string('extension');
            $table->timestamps();
        });
    }
}