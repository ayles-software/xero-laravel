<?php

namespace AylesSoftware\XeroLaravel;

use Exception;
use XeroPHP\Application;
use AylesSoftware\XeroLaravel\Concerns\HasXeroRelationships;

class Xero extends Application
{
    use HasXeroRelationships;

    /**
     * @param $token
     * @param $tenantId
     * @throws Exception
     */
    public function __construct($token, $tenantId)
    {
        parent::__construct($token, $tenantId);

        $this->populateRelationshipToModelMaps();
    }
}
