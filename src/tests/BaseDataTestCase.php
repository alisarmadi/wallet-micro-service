<?php

namespace Tests;

use Dotenv\Dotenv;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class BaseDataTestCase extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Dotenv::create(Env::getRepository(), base_path(), '.env.testing')->load();
        Artisan::call('cache:clear');
        Artisan::call('db:create');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

        DB::beginTransaction();
    }

    public function tearDown(): void
    {
        DB::rollBack();
    }
}
