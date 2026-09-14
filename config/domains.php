<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Canonical Host
    |--------------------------------------------------------------------------
    |
    | The host name the site is currently published under. Requests arriving on
    | one of the legacy hosts below are redirected here. When left empty, no
    | redirecting takes place.
    |
    */

    'canonical_host' => env('CANONICAL_HOST'),

    /*
    |--------------------------------------------------------------------------
    | Legacy Hosts
    |--------------------------------------------------------------------------
    |
    | Host names the site has previously been published under, and that still
    | resolve to this application. Given as a comma separated list, so that a
    | host can be retired by changing the environment rather than the code.
    |
    */

    'legacy_hosts' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('LEGACY_HOSTS', ''))
    ))),

    /*
    |--------------------------------------------------------------------------
    | Redirect Status Code
    |--------------------------------------------------------------------------
    |
    | The status code used when redirecting from a legacy host. A permanent
    | redirect is what search engines act on, but browsers cache it
    | indefinitely, so a temporary 302 is useful while verifying a new host.
    |
    */

    'redirect_status' => (int) env('LEGACY_REDIRECT_STATUS', 301),

];
