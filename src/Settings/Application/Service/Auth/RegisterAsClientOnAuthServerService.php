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
    private $appName;

    public function __construct(
        $authEndpoint,
        $appName
    ) {
        $this->authEndpoint = $authEndpoint;
        $this->appName      = $appName;
    }

    /**
     * @param RegisterAsClientOnAuthServerRequest $request
     *
     * @return mixed
     */
    public function execute($request = null)
    {
        $client   = new Client();
        $response = $client->request('POST', $this->authEndpoint, [
            'form_params' => [
                'name'     => $this->appName,
                'username' => $request->getUsername(),
                'password' => $request->getPassword(),
            ],
        ]);

        file_put_contents('./config/auth_key.txt', $response->getBody());

        return $response->getBody();
    }
}
