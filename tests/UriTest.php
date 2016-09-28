<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UriTest extends TestCase
{
    public function providerAllUrisWithResponseCode()
    {
        return [
            ['/', 200],                 # Assert valid
            ['/order', 200],            # Assert valid
            ['/order/create', 405],     # Assert invalid method
            ['/order/show', 404],       # Assert not found
            ['/order/show/1', 500],     # Assert server error
            ['/tests', 404],            # Assert not found
            ['/help', 200],             # Assert valid
            ['/help/2', 404],           # Assert not found
            ['/login', 200],            # Assert valid
            ['/login/2', 404],          # Assert not found
            ['/tracking', 200],         # Assert valid
            ['/tracking/2', 404],       # Assert not found
            ['/logout', 302],           # Assert redirection
            ['/home', 302],             # Assert redirection
        ];
    }
    /**
     * This is kind of a smoke test
     *
     * @dataProvider providerAllUrisWithResponseCode
     **/
    public function testApplicationUriResponses($uri, $responseCode)
    {
        print sprintf('checking URI : %s - to be %d - %s', $uri, $responseCode, PHP_EOL);
        $response = $this->call('GET', $uri);
        $this->assertEquals($responseCode, $response->status());
    }
}
