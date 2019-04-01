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

    /**
     * @param User $user
     * @param array $requestedData
     * @param $audience
     *
     * @param $subject
     *
     * @return \Lcobucci\JWT\Token
     */
    public function execute(
        User $user,
        array $requestedData,
        $audience,
        $subject
    ): string
    {
        $builder = $this->constructBasicTokenFromRequest($user, $audience, $subject);

        $builder    = $this->addAdditionalData(
            $builder,
            $this->checkIfValidRequests(
                $requestedData
            ),
            $user);
        $signer     = new Sha256();
        $keychain   = new Keychain();
        $privateKey = $keychain->getPrivateKey('file:///application/config/jwt/private.pem');
        $builder->sign($signer, $privateKey);

        $this->verifyToken($builder->getToken(), $signer, $keychain->getPublicKey('file:///application/config/jwt/public.pem'));

        return $builder->getToken()->__toString();
    }

    private function constructBasicTokenFromRequest(User $user, $audience, $subject): Builder
    {
        $builder = new Builder();

        return $builder
            ->setIssuer('me')
            ->setAudience($audience)
            ->setIssuedAt(time())
            ->setId(time() . hash('sha256', $user->getId() . $user->getUsername() . $user->getId()))
            ->setSubject($subject)
            ->setExpiration(time() + 3600);
    }

    private function checkIfValidRequests(array $requests): array
    {
        foreach ($requests as $request) {
            if ( ! in_array($request, $this->validRequests)) {
                throw new RequestedDataNotValidException(['requestedData' => $request]);
            }
        }

        return $requests;
    }

    private function addAdditionalData(Builder $builder, array $requested, User $user): Builder
    {
        foreach ($requested as $request) {
            switch ($request) {
                case 'USER_ROLE':
                    $builder->set('rol', $user->getRoles());
                    break;
                case 'USER_USERNAME':
                    $builder->set('usn', $user->getUsername());
                    break;
            }
        }

        return $builder;
    }

    public function verifyToken(Token $token, Signer $signer, $privateKey): void
    {
        if(!$token->verify($signer, $privateKey)){
            throw new TokenGeneratorErrorException(['contact' => 'me']);
        }
    }
}
