<?php

namespace BrightComponents\Responder\Tests\Integration;

use Artisan;

class CommandTest extends IntegrationTestCase
{
    /** @test */
    public function bright_responder_command_makes_responder_with_correct_respond_method()
    {
        Artisan::call('adr:responder', ['name' => 'MyResponder']);

        include_once base_path().'/app/Http/Responders/MyResponder.php';

        $this->assertInstanceOf(\BrightComponents\Responder\Responder::class, $this->app[\App\Http\Responders\MyResponder::class]);
        $this->assertMethodExists(\App\Http\Responders\MyResponder::class, config('responders.method'));
    }

    public function assertMethodExists(string $className, string $methodName)
    {
        $this->assertTrue(method_exists($className, $methodName));
    }
}
