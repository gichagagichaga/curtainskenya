<?php

use Illuminate\Support\Facades\URL;

test('renders Curtains Kenya branding and production canonical metadata', function () {
    config()->set('app.url', 'https://curtainskenya.com');
    URL::forceRootUrl('https://curtainskenya.com');
    URL::forceScheme('https');

    $this->get('/')
        ->assertSee('Curtains Kenya')
        ->assertSee('https://curtainskenya.com', false)
        ->assertSee('images/curtains-kenya-logo.png', false)
        ->assertDontSee('CurtainWorld');
});

test('publishes a domain-specific robots response and sitemap', function () {
    config()->set('app.url', 'https://curtainskenya.com');
    URL::forceRootUrl('https://curtainskenya.com');
    URL::forceScheme('https');

    $this->get('/robots.txt')
        ->assertOk()
        ->assertSee('Sitemap: https://curtainskenya.com/sitemap.xml');

    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml')
        ->assertSee('https://curtainskenya.com', false);
});
