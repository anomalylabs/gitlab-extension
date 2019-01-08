<?php namespace Anomaly\GitlabExtension\Gitlab;

use Abraham\GitlabOAuth\GitlabOAuth;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;
use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class GitlabExtensionPlugin
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GitlabExtensionPlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'gitlab',
                function ($method) {
                    return new PluginCriteria(
                        'get',
                        function (Collection $options, GitlabConnection $connection) use ($method) {

                            /* @var GitlabOAuth $connection */
                            return $connection->get($method, $options->all());
                        }
                    );
                }
            ),
        ];
    }
}
