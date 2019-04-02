<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 13:13
 */

namespace Settings\Application\Service\Auth;


use GuzzleHttp\Client;
use Transactional\Interfaces\TransactionalServiceInterface;

class RegisterAsClientOnAuthServerService implements TransactionalServiceInterface
{
    private $authEndpoint;

    public function __construct(
        $authEndpoint
    )
    {
        $this->authEndpoint = $authEndpoint;
    }

    public function execute($request = null)
    {
        $client = new Client();
        $client->request('POST');
    }
}
