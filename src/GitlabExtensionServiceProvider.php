<?php namespace Anomaly\GitlabExtension;

use Abraham\GitlabOAuth\GitlabOAuth;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\GitlabExtension\Gitlab\GitlabConnection;
use Anomaly\GitlabExtension\Gitlab\GitlabExtensionPlugin;
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

        /**
         * Setup our pre-configured GitLab client instance alias.
         */
        if ($token = $config->get('anomaly.extension.gitlab::gitlab.token')) {
            $this->app->singleton(
                GitlabConnection::class,
                function () use ($token) {

                    $client = new Client();

                    $client->authenticate($token, null, 'http_token');

                    return new GitlabConnection($client);
                }
            );
        }
    }

}
