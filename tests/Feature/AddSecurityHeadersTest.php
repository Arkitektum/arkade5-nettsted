<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddSecurityHeadersTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_front_page_has_referrer_and_permissions_policies(): void
    {
        $response = $this->get('/');

        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Permissions-Policy');
        $this->assertStringContainsString('camera=()', $response->headers->get('Permissions-Policy'));
    }

    public function test_the_front_page_policy_allows_its_external_sources(): void
    {
        $policy = $this->get('/')->headers->get('Content-Security-Policy');

        $this->assertStringContainsString("frame-ancestors 'none'", $policy);
        $this->assertStringContainsString('https://unpkg.com', $policy);
        $this->assertStringContainsString('https://cache.kartverket.no', $policy);
        $this->assertStringContainsString('https://data.brreg.no', $policy);
        $this->assertStringNotContainsString("'unsafe-eval'", $policy);
        $this->assertStringNotContainsString("'unsafe-inline'", $policy);
    }

    public function test_each_response_gets_a_new_script_nonce(): void
    {
        $nonce = fn () => preg_match("/script-src [^;]*'nonce-([A-Za-z0-9+\/=]{24})'/", $this->get('/')->headers->get('Content-Security-Policy'), $matches)
            ? $matches[1]
            : null;

        $first = $nonce();
        $second = $nonce();

        $this->assertNotNull($first);
        $this->assertNotNull($second);
        $this->assertNotSame($first, $second);
    }

    public function test_application_pages_get_the_application_policy(): void
    {
        $policy = $this->get('/no-such-page')->headers->get('Content-Security-Policy');

        $this->assertStringContainsString("script-src 'self' 'unsafe-eval'", $policy);
        $this->assertStringContainsString('https://fonts.bunny.net', $policy);
        $this->assertStringNotContainsString('https://unpkg.com', $policy);
    }
}
