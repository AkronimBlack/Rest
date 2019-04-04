<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 13:13
 */

namespace Settings\Application\Service\Auth;


use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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

        if($response->getStatusCode() !== JsonResponse::HTTP_CREATED){
            return $response->getBody();
        }

        echo 'Authentication successful!'. PHP_EOL;
        echo 'Writing token to file!'. PHP_EOL;
        $decodedJson = json_decode($response->getBody(), true);
        if(isset($decodedJson['token'])){
            foreach ($decodedJson as $key => $value){
                file_put_contents('./config/auth_key.txt', $key . ': ' . $value);
            }
        }
        echo 'Token saved!'. PHP_EOL;

    }
}
