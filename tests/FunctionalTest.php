<?php

/*
 * OAuth2 Client Bundle
 * Copyright (c) KnpUniversity <http://knpuniversity.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KnpU\OAuth2ClientBundle\Tests;

use KnpU\OAuth2ClientBundle\Tests\app\TestKernel;

class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    public function testServicesAreUsable()
    {
        $kernel = new TestKernel('dev', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        $this->assertTrue($container->has('knpu.oauth2.client.my_facebook'));

        /** @var \KnpU\OAuth2ClientBundle\Client\OAuth2Client $client */
        $client = $container->get('knpu.oauth2.client.my_facebook');
        $this->assertInstanceOf('KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient', $client);
        $this->assertInstanceOf('League\OAuth2\Client\Provider\Facebook', $client->getOAuth2Provider());

        $client2 = $container->get('knpu.oauth2.registry')
            ->getClient('my_facebook');
        $this->assertSame($client, $client2);
        $this->assertTrue($container->has('oauth2.registry'));
    }
}
