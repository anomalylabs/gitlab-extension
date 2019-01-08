<?php namespace Anomaly\GitlabExtension;

use Abraham\GitlabOAuth\GitlabOAuth;
use Anomaly\GitlabExtension\Gitlab\GitlabConnection;
use Anomaly\GitlabExtension\Gitlab\GitlabExtensionPlugin;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Gitlab\Client;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GitlabExtensionServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GitlabExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        GitlabExtensionPlugin::class,
    ];

    /**
     * Boot the addon.
     *
     * @param Repository $config
     */
    public function boot(Repository $config)
    {

        $token = $config->get('anomaly.extension.gitlab::gitlab.token');
        $url   = $config->get('anomaly.extension.gitlab::gitlab.url');

        /**
         * Setup our pre-configured GitLab client instance alias.
         */
        if ($token && $url) {
            $this->app->singleton(
                GitlabConnection::class,
                function () use ($token, $url) {

                    $client = Client::create($url);

                    $client->authenticate($token, Client::AUTH_URL_TOKEN);

                    return new GitlabConnection($client);
                }
            );
        }
    }

}
