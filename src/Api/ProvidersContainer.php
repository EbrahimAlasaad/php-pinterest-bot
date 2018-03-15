<?php

namespace seregazhuk\PinterestBot\Api;

use seregazhuk\PinterestBot\Api\Contracts\HttpClient;
use seregazhuk\PinterestBot\Api\Providers\Auth;
use seregazhuk\PinterestBot\Api\Providers\Boards;
use seregazhuk\PinterestBot\Api\Providers\BoardSections;
use seregazhuk\PinterestBot\Api\Providers\Comments;
use seregazhuk\PinterestBot\Api\Providers\Core\Provider;
use seregazhuk\PinterestBot\Api\Providers\Inbox;
use seregazhuk\PinterestBot\Api\Providers\Interests;
use seregazhuk\PinterestBot\Api\Providers\Keywords;
use seregazhuk\PinterestBot\Api\Providers\Password;
use seregazhuk\PinterestBot\Api\Providers\Pinners;
use seregazhuk\PinterestBot\Api\Providers\Pins;
use seregazhuk\PinterestBot\Api\Providers\Suggestions;
use seregazhuk\PinterestBot\Api\Providers\Topics;
use seregazhuk\PinterestBot\Api\Providers\User;
use seregazhuk\PinterestBot\Exceptions\WrongProvider;

/**
 * @property-read Pins $pins
 * @property-read Inbox $inbox
 * @property-read User $user
 * @property-read Boards $boards
 * @property-read Pinners $pinners
 * @property-read Keywords $keywords
 * @property-read Interests $interests
 * @property-read Topics $topics
 * @property-read Auth $auth
 * @property-read Comments $comments
 * @property-read Password $password
 * @property-read Suggestions $suggestions
 * @property-read BoardSections $boardSections
 *
 * Class ProvidersContainer
 * @package seregazhuk\PinterestBot\Api
 */
class ProvidersContainer
{
    /**
     * References to the request that travels
     * through the application.
     *
     * @var Request
     */
    protected $request;

    /**
     * A array containing the cached providers.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * @param Request $request
     * @param Provider[] $providers
     */
    public function __construct(Request $request, Provider ...$providers)
    {
        $this->request = $request;

        foreach ($providers as $provider) {
            $alias = strtolower(get_class($provider));
            $this->providers[$alias] = $provider;
        }
    }

    /**
     * Magic method to access different providers from the container.
     *
     * @param string $provider
     * @return Provider
     * @throws WrongProvider
     */
    public function __get($provider)
    {
        if (!isset($this->providers[$provider])) {
            throw new WrongProvider("Provider $provider not found.");
        }

        return $this->providers[$provider];
    }

    /**
     * Returns HttpClient object for setting user-agent string or
     * other CURL available options.
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->request->getHttpClient();
    }
}
