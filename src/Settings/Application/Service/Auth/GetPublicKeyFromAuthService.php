<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 04-Apr-19
 * Time: 18:53
 */

namespace Settings\Application\Service\Auth;


use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Transactional\Interfaces\TransactionalServiceInterface;

class GetPublicKeyFromAuthService implements TransactionalServiceInterface
{
    private $authEndpoint;
    private $authKeyEndPoint;
    private $projectDir;

    public function __construct(
        $authEndpoint,
        $authKeyEndPoint,
        $projectDir
    ) {
        $this->authEndpoint = $authEndpoint;
        $this->authKeyEndPoint = $authKeyEndPoint;
        $this->projectDir = $projectDir;
    }

    /**
     * @param GetPublicKeyFromAuthRequest $request
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute($request = null)
    {
        $file =  file_get_contents('./config/auth_key.txt');
        [$key, $token] = explode(': ', $file);
        $client = new Client();
        $response = $client->request('POST', $this->authEndpoint . $this->authKeyEndPoint, [
            'headers' => [
                'Authorization'     => 'Bearer ' . $token
            ]
        ]);
        if($response->getStatusCode() === JsonResponse::HTTP_OK){
            echo 'Authentication successful!' . PHP_EOL;
            echo 'Saving key to file!' . PHP_EOL;
            $data = json_decode($response->getBody() , true);
            file_put_contents($this->projectDir . "/config/JWT/Auth/public.pem" , $data['key']);
            echo 'File created!' . PHP_EOL;
        }
    }
}
