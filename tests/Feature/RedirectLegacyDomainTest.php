<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectLegacyDomainTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'domains.canonical_host' => 'new.example.test',
            'domains.legacy_hosts' => ['old.example.test'],
            'domains.redirect_status' => 301,
        ]);
    }

    public function test_a_request_on_a_legacy_host_is_redirected_to_the_canonical_host(): void
    {
        $response = $this->get('http://old.example.test/');

        $response->assertStatus(301);
        $response->assertRedirect('https://new.example.test/');
    }

    public function test_the_redirect_keeps_the_path_and_query_string(): void
    {
        $response = $this->get('http://old.example.test/admin/statistikk?limit=10');

        $response->assertRedirect('https://new.example.test/admin/statistikk?limit=10');
    }

    public function test_a_request_on_the_canonical_host_is_not_redirected(): void
    {
        $response = $this->get('http://new.example.test/no-such-page');

        // Passed on to the router, which has no route for it, rather than
        // being sent to the canonical host it already arrived on.
        $response->assertStatus(404);
    }

    public function test_an_api_request_on_a_legacy_host_is_not_redirected(): void
    {
        $response = $this->get('http://old.example.test/api/arkade-versions');

        $response->assertStatus(200);
    }

    public function test_a_download_on_a_legacy_host_is_not_redirected(): void
    {
        $response = $this->post('http://old.example.test/api/arkade-downloads', [
            'arkadeUI' => 'GUI',
            'downloaderEmail' => 'nedlaster@example.test',
        ]);

        // Reaches the route and finds no matching release, rather than being
        // turned into a redirect the client would follow as a bodyless GET.
        $response->assertStatus(404);
    }

    public function test_no_redirecting_takes_place_without_a_canonical_host(): void
    {
        config(['domains.canonical_host' => null]);

        $response = $this->get('http://old.example.test/no-such-page');

        $response->assertStatus(404);
    }
}
