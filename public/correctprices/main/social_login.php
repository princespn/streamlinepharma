<?php
//Include Hybridauth's basic autoloader
include 'hybridauth/src/autoload.php';

//Import Hybridauth's namespace
use Hybridauth\Hybridauth; 

/**
 * 1. Build the adapter configuration array
 */
$config = [
    /**
     * Required: Callback URL
     *
     * The callback url is the location where a provider (Google in this case) will redirect the use once they
     * authenticate and authorize your application.
     *
     * For this example we choose to come back to this same script, however in your project you'll have to you need to
     * replace it with the valid url to yours.
     *
     * For convenience, Hybridauth provides an utility function `Hybridauth\HttpClient\Util::getCurrentUrl()` that can
     * generate the current page url for you and you can use it for the callback.
     */
    'callback' => 'http://localhost/path/to/this/script.php',

    /**
     * Required*: Application credentials
     *
     * A set of keys used by providers to identify your website and only required by those using OAuth 1 and OAuth 2. To acquire
     * these you'll have to register an application on provider's site. In the case of Google for instance you can refer to
     * https://support.google.com/cloud/answer/6158849
     */
    'keys' => [ 
        'id'     => 'your-google-client-id',
        'secret' => 'your-google-client-secret' 
    ],

    /**
     * Optional: Custom Scope
     *
     * Providers using OAuth 2 will requires to know the scope of the authorization a user is going to give to your
     * application, and Hybridauth's adapters will request a limited scope by default, however you may specify a custom
     * value to overwrite default ones.
     */
    'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',

    /**
     * Optional: Custom Provider's API end points
     *
     * Hybridauth allows you to overwrite all the provider's API end point, which might be useful in some cases like when
     * there is a need to use a different API version for example.
     */
    'endpoints' => [
        'api_base_url' => 'https://www.googleapis.com/plus/v1/',
        'authorize_url' => 'https://accounts.google.com/o/oauth2/auth',
        'access_token_url' => 'https://accounts.google.com/o/oauth2/token',
    ],

    /**
    * Optional: Custom Provider's Authorize Url Parameters
    *
    * Certain providers enables you to customize the authorization url which you can optionality pass in adapter's config
    * as an associative array.
    */
    'authorize_url_parameters' => [
        'approval_prompt' => 'force',
        'access_type'     => 'offline',
        'hd'              => '',
        'state'           => ''
        //And so on.
    ],

    /**
     * Optional: Debug Mode
     *
     * The debug mode is set to false by default, however you can rise its level to either 'info', 'debug' or 'error'.
     *
     * debug_mode: false|info|debug|error
     * debug_file: Path to file writeable by the web server. Required if only 'debug_mode' is not false.
     */
    'debug_mode' => false,
    'debug_file' => __FILE__ . '.log',

    /**
     * Optional: CURL Settings
     *
     * For more information, refer to: http://www.php.net/manual/function.curl-setopt.php
     */
    'curl_options' => [
        //Set a custom certificate
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_CAINFO         => '/path/to/your/certificate.crt',

        //Set a valid proxy address
        CURLOPT_PROXY          => '8.8.8.8',

        //Set a custom user agent
        CURLOPT_USERAGENT      => 'User Agent String'
        
        //And so on.
    ]
];

/**
* 2. Instantiate Google adapter using the configuration array we built
*/
$adapter = new Hybridauth\Provider\Google($config);

/**
* 3. Sign in a user with Google
*
* Hybridauth will attempt to negotiate with the Google api and authenticate the user.
* This call will basically do one of 3 things...
* 1) Redirect (with exit) away to show an authentication screen for a provider (e.g. Facebook's OAuth confirmation page)
* 2) Finalize an incoming authentication and store access data in a session
* 3) Confirm a session exists and do nothing
* If for whatever reason the process fails, Hybridauth will then throw an exception.
*
* Note that if the user is already authenticated, then any subsequent call to this method will be ignored.
*/
$adapter->authenticate();

/**
* Retrieve OAuth 1 / OAuth 2 Access Tokens
*
* These access tokens can be stored to database and later used to restore user's session.
*/
$accessToken = $adapter->getAccessToken();

/**
* 4. Perform actions in behalf of connected user
*
* At this point the authentication process has succeeded, and we can proceed with our application logic. For example we may
* attempt to retrieve the user profile.
*/
$userProfile = $adapter->getUserProfile();