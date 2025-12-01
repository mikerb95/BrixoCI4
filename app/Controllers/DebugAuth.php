<?php

namespace App\Controllers;

class DebugAuth extends BaseController
{
    public function index()
    {
        $session = session();

        echo "<h1>Debug Auth Info</h1>";

        echo "<h2>Environment</h2>";
        echo "CI_ENVIRONMENT: " . env('CI_ENVIRONMENT') . "<br>";
        echo "Base URL: " . config('App')->baseURL . "<br>";

        echo "<h2>Request Headers</h2>";
        $headers = $this->request->headers();
        foreach ($headers as $header) {
            echo $header->getName() . ": " . $header->getValue() . "<br>";
        }

        echo "<h2>Session</h2>";
        echo "Session ID: " . session_id() . "<br>";
        echo "Session User Data: <pre>" . print_r($session->get('user'), true) . "</pre>";
        echo "Session Flash Data: <pre>" . print_r($session->getFlashdata(), true) . "</pre>";

        echo "<h2>Cookies</h2>";
        echo "<pre>" . print_r($_COOKIE, true) . "</pre>";

        echo "<h2>Config</h2>";
        echo "Cookie Secure: " . (config('Cookie')->secure ? 'true' : 'false') . "<br>";
        echo "Cookie Domain: " . config('Cookie')->domain . "<br>";
        echo "Cookie Path: " . config('Cookie')->path . "<br>";
        echo "Proxy IPs: <pre>" . print_r(config('App')->proxyIPs, true) . "</pre>";

        echo "<h2>Server Vars</h2>";
        echo "REMOTE_ADDR: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "<br>";
        echo "HTTP_X_FORWARDED_PROTO: " . ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'Not Set') . "<br>";
        echo "HTTPS: " . ($_SERVER['HTTPS'] ?? 'Not Set') . "<br>";

        echo "<h2>Test Session Write</h2>";
        $session->set('debug_test', 'Hello ' . time());
        echo "Set 'debug_test' to session. Refresh to see if it persists.<br>";
        echo "Current 'debug_test': " . $session->get('debug_test');
    }
}
