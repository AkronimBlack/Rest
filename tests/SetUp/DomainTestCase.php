<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 11-Feb-19
 * Time: 21:15
 */

namespace App\Tests\SetUp;



use Rest\Resources\DataFixtures\ClientFixture;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Rest\Domain\Entity\User\User;
use Rest\Resources\DataFixtures\UserFixture;
use Symfony\Bundle\FrameworkBundle\Client;

class DomainTestCase extends WebTestCase
{
    protected $fixtures;

    public function loadTestDatabase(): void
    {
        $this->fixtures = $this->loadFixtures(
            array(
                'Rest\Resources\DataFixtures\RoleFixture',
                'Rest\Resources\DataFixtures\PermissionFixture'
            )
        )->getReferenceRepository();

    }

    public function runAsAdmin(): Client
    {
        $client = self::createClient();
        $user = $this->fixtures->getReference(UserFixture::ADMIN_USERNAME);
        $client->setServerParameters(array(
            'HTTP_Authorization' => 'Bearer ' . $user->getAccessTokens()->last()->getToken()
        ));
        return $client;
    }
}
