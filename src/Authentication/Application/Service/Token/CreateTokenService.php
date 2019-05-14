<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Feb-19
 * Time: 20:01
 */

namespace Authentication\Application\Service\Token;

use Authentication\Domain\Entity\User\AccessToken;
use Authentication\Domain\Entity\User\User;
use Authentication\Domain\Entity\Values\TokenType;
use Authentication\Domain\Services\Exceptions\NotAllParametersHaveBeenSetException;
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
        if ( ! $request->getAudience()) {
            throw new NotAllParametersHaveBeenSetException(
                ['required' => 'audience']
            );
        }

        $user = $this->setOlderTokensForThatAudienceToInactive($request->getUser(), $request->getAudience());

        $this->isPossible($request);

        switch ($request->getType()) {
            case TokenType::JWT_TOKEN:
                $token = $this->constructJwtToken($user, $request->getAudience(), $request->getRequestedData(), $request->getSubject());
                break;
            case TokenType::BASIC_TOKEN:
                $token = bin2hex(random_bytes(60));
                break;
            default:
                $token = $this->constructJwtToken($user, $request->getAudience(), $request->getRequestedData(), $request->getSubject());
        }

        $user->addAccessToken(
            new AccessToken(
                $request->getType() ?: TokenType::JWT_TOKEN,
                $request->getAudience(),
                $token
            )
        );

        return $token;
    }

    /**
     * @param CreateTokenRequest $request
     */
    private function isPossible($request): void
    {
        if ($request->getType() && ! in_array($request->getType(), TokenType::getTokenTypes(), false)) {
            throw new TokenTypeNotSupportedException(['type' => $request->getType()]);
        }
    }

    /**
     * @param User $user
     * @param string $audience
     *
     * @return User
     */
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

    /**
     * @param User $user
     * @param $audience
     * @param null $subject
     * @param array|null $requestedData
     *
     * @return string
     */
    private function constructJwtToken(User $user, $audience,array $requestedData = null, $subject = null): string
    {
        return $this->createJwtTokenService->execute(
            $user,
            $audience,
            $requestedData,
            $subject
        );
    }
}
