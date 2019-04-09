<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 23-Feb-19
 * Time: 18:14
 */

namespace Authentication\Domain\Services\Token;

use Authentication\Domain\Entity\User\User;
use Authentication\Domain\Services\Exceptions\RequestedDataNotValidException;
use Authentication\Domain\Services\Exceptions\TokenGeneratorErrorException;
use Firebase\JWT\JWT;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;

class CreateJwtTokenService
{
    private $validRequests = array(
        'USER_USERNAME',
        'USER_ROLE',
    );
    private $privateKeyLocation;
    private $projectDir;
    private $tokenArgs = [];
    private $token;

    public function __construct(
        $privateKeyLocation,
        $projectDir,
        $appName
    ) {
        $this->privateKeyLocation = $privateKeyLocation;
        $this->projectDir         = $projectDir;
        $this->tokenArgs['iss']   = $appName;
    }

    /**
     * @param User $user
     * @param array $requestedData
     * @param $audience
     *
     * @param $subject
     *
     * @return string
     */
    public function execute(
        User $user,
        $audience,
        array $requestedData = null,
        $subject = null
    ): string {
        if ($subject) {
            $this->tokenArgs['sub'] = $subject;
        }
        $this->tokenArgs['aud'] = $audience;
        $this->checkIfValidRequests($requestedData);
        $this->addAdditionalData($user, $requestedData);

        $this->sign();

        return $this->token;
    }

    /**
     * @param array $requests
     */
    private function checkIfValidRequests(array $requests = null): void
    {
        if ( ! empty($requests)) {
            foreach ($requests as $request) {
                if ( ! in_array($request, $this->validRequests, false)) {
                    throw new RequestedDataNotValidException(['requestedData' => $request]);
                }
            }
        }
    }

    /**
     * @param array $requested
     * @param User $user
     */
    private function addAdditionalData(User $user, array $requested = null): void
    {
        if ( ! empty($requested)) {
            foreach ($requested as $request) {
                switch ($request) {
                    case 'USER_ROLE':
                        $this->tokenArgs['rol'] = $user->getRoles();
                        break;
                    case 'USER_USERNAME':
                        $this->tokenArgs['usn'] = $user->getUsername();
                        break;
                }
            }
        }
    }

    private function sign(): void
    {
        $privateKey  = file_get_contents($this->projectDir . $this->privateKeyLocation);
        $this->token = JWT::encode($this->token, $privateKey, 'RS256');
    }
}
