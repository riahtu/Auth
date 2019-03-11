<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Feb-19
 * Time: 20:01
 */

namespace Authentication\Application\Service\Token;


use Authentication\Domain\Entity\AccessToken;
use Authentication\Domain\Entity\User;
use Authentication\Domain\Entity\Values\TokenType;
use Authentication\Domain\Services\Exceptions\TokenTypeNotSupportedException;
use Authentication\Domain\Services\Token\CreateJwtTokenService;
use Transactional\Interfaces\TransactionalServiceInterface;

class CreateTokenService implements TransactionalServiceInterface
{
    /**
     * @var CreateJwtTokenService
     */
    private $createJwtTokenService;

    /**
     * CreateTokenService constructor.
     *
     * @param CreateJwtTokenService $createJwtTokenService
     */
    public function __construct(CreateJwtTokenService $createJwtTokenService)
    {
        $this->createJwtTokenService = $createJwtTokenService;
    }

    /**
     * @param CreateTokenRequest $request
     *
     * @return string
     *
     * @throws \Exception
     */
    public function execute($request = null): string
    {

        $this->isPossible($request);

        $user = $this->setOlderTokensForThatAudienceToInactive($request->getUser(), $request->getIntendedFor());

        if($request->getType() === TokenType::JWT_TOKEN){
            $token = $this->createJwtTokenService->execute(
                $user,
                $request->getRequestedData(),
                $request->getIntendedFor(),
                $request->getSubject()
            );
        }
        elseif ($request->getType() === TokenType::BASIC_TOKEN){
            $token = bin2hex(random_bytes(60));
        }
        //check if audience is registered as a client

        //persist the generated id
        $user->addAccessToken(new AccessToken(
                $request->getType(),
                $request->getIntendedFor(),
                $token
            )
        );

        return $token;
    }

    private function isPossible($request): void
    {
        if ( ! in_array($request->getType(), TokenType::getTokenTypes())) {
            throw new TokenTypeNotSupportedException(['type' => $request->getType()]);
        }
    }

    private function setOlderTokensForThatAudienceToInactive(User $user, string $audience): User
    {
        $tokens = $user->getAccessTokens();
        /** @var AccessToken $token */
        foreach ($tokens as $token) {
            if ($token->getAudience() === $audience) {
                $token->setActive(false);
            }
        }

        return $user;
    }
}
