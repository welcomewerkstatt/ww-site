<?php

namespace Thathoff\Oauth;

use Kirby\Toolkit\Collection;

class ProvidersManager extends Collection
{
    private $kirby = null;

    public function __construct(\Kirby\Cms\App $kirby)
    {
        $this->kirby = $kirby;
        $providers = $this->kirby->option('thathoff.oauth.providers');

        if (!is_array($providers)) {
            return;
        }

        foreach ($providers as $id => $provider) {
            if (empty($provider['redirectUri'])) {
                $provider['redirectUri'] = kirby()->request()->url()->base() . '/' . kirby()->request()->path()->toString();
            }

            $this->set($id, new Provider($id, $provider));
        }
    }
}
