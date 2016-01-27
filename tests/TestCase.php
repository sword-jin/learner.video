<?php

use Learner\Exceptions\Handler;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost:8080';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    protected function disableExceptionHandling()
    {
        app()->instance(Handler::class, new PassThroughHandler);
    }

    protected function addValidator() {
        $this->app['validator']->extend('valid_username', function($attr, $value, $params) {
            return ! in_array($value, config('config.forbidden_usernames', []));
        }, trans('validators.username'));
    }

    protected function createAGeneralUser()
    {
        return factory(Learner\Models\User::class)->create([
            'username' => 'learner',
            'email'    => 'foo@bar.com',
            'password' => Hash::make('121212'),
        ]);
    }
}

class PassThroughHandler extends Handler
{
    public function __construct() {}

    public function report(Exception $e)
    {
        // no-op
    }
    public function render($request, Exception $e)
    {
        throw $e;
    }
}
