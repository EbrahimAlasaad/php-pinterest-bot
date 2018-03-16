<?php

namespace seregazhuk\PinterestBot\Factories;

use seregazhuk\PinterestBot\Api\Providers\Auth;
use seregazhuk\PinterestBot\Api\Providers\Boards;
use seregazhuk\PinterestBot\Api\Providers\BoardSections;
use seregazhuk\PinterestBot\Api\Providers\Comments;
use seregazhuk\PinterestBot\Api\Providers\Common\ProfileResolver;
use seregazhuk\PinterestBot\Api\Providers\Inbox;
use seregazhuk\PinterestBot\Api\Providers\Interests;
use seregazhuk\PinterestBot\Api\Providers\Keywords;
use seregazhuk\PinterestBot\Api\Providers\Password;
use seregazhuk\PinterestBot\Api\Providers\Pinners;
use seregazhuk\PinterestBot\Api\Providers\Pins;
use seregazhuk\PinterestBot\Api\Providers\Suggestions;
use seregazhuk\PinterestBot\Api\Providers\Topics;
use seregazhuk\PinterestBot\Api\Providers\User;
use seregazhuk\PinterestBot\Api\Request;
use seregazhuk\PinterestBot\Api\Response;
use seregazhuk\PinterestBot\Api\Session;
use seregazhuk\PinterestBot\Helpers\Cookies;
use seregazhuk\PinterestBot\Api\CurlHttpClient;
use seregazhuk\PinterestBot\Api\ProvidersContainer;

class PinterestBot
{
    /**
     * Initializes Bot instance and all its dependencies.
     *
     * @return ProvidersContainer
     */
    public static function create()
    {
        $httpClient = new CurlHttpClient(new Cookies());
        $request = new Request($httpClient, new Session());

        return new ProvidersContainer(
            $request,
            new Auth(new ProfileResolver($request), $request),
            new Boards(new ProfileResolver($request), $request),
            new BoardSections(new ProfileResolver($request), $request),
            new Comments(new ProfileResolver($request), $request),
            new Inbox(new ProfileResolver($request), $request),
            new Interests(new ProfileResolver($request), $request),
            new Keywords(new ProfileResolver($request), $request),
            new Password(new ProfileResolver($request), $request),
            new Pinners(new ProfileResolver($request), $request),
            new Pins(new ProfileResolver($request), $request),
            new Suggestions(new ProfileResolver($request), $request),
            new Topics(new ProfileResolver($request), $request),
            new User(new ProfileResolver($request), $request)
        );
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
