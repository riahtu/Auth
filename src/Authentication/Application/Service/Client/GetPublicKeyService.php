<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 08:41
 */

namespace Authentication\Application\Service\Client;


use Authentication\Domain\Services\Exceptions\ClientIpDoesNotMachException;

class GetPublicKeyService
{
    private $projectDir;
    private $publicKeyLocation;

    public function __construct(
        $projectDir,
        $publicKeyLocation
    ) {
        $this->projectDir = $projectDir;
        $this->publicKeyLocation = $publicKeyLocation;
    }

    /**
     * @param GetPublicKeyRequest $request
     *
     * @return false|string
     */
    public function execute($request = null)
    {
        if($request->getRequestIp() !== $request->getClient()->getIp()){
            throw new ClientIpDoesNotMachException(['request_ip' => $request->getRequestIp()]);
        }
        $file                        = file_get_contents($this->projectDir . $this->publicKeyLocation);
        $returnData['key']           = $file;
        $returnData['requestedBy']   = $request->getClient()->getName();
        $returnData['requestedByIp'] = $request->getClient()->getIp();

        return $returnData;
    }
}
