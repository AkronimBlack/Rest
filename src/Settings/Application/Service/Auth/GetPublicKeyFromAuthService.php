<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 04-Apr-19
 * Time: 18:53
 */

namespace Settings\Application\Service\Auth;


use GuzzleHttp\Client;
use Transactional\Interfaces\TransactionalServiceInterface;

class GetPublicKeyFromAuthService implements TransactionalServiceInterface
{
    private $authEndpoint;
    private $authKeyEndPoint;

    public function __construct(
        $authEndpoint,
        $authKeyEndPoint
    ) {
        $this->authEndpoint = $authEndpoint;
        $this->authKeyEndPoint = $authKeyEndPoint;
    }

    /**
     * @param GetPublicKeyFromAuthRequest $request
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute($request = null)
    {

        if(!$request->getUsername() || !$request->getPassword()){
            return 'Username and password required';
        }

        $file =  file_get_contents('./config/auth_key.txt');
        [$key, $token] = explode(': ', $file);
        $client = new Client();
        $response = $client->request('POST', $this->authEndpoint . $this->authKeyEndPoint, [
            'form_params' => [
                'username' => $request->getUsername(),
                'password' => $request->getPassword(),
            ],
            'headers' => [
                'Authorization'     => 'Bearer ' . $token
            ]
        ]);
        return $response->getStatusCode();
    }
}
