<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class FcmService
{
    protected Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * Send a push notification to a given FCM topic.
     *
     * @param  string  $title
     * @param  string  $body
     * @param  string  $topic
     * @return array{success: bool, message: string}
     */
    public function sendToTopic(string $title, string $body, string $topic): array
    {
        try {
            $accessToken = $this->getAccessToken();
            $projectId = $this->getProjectId();

            $response = $this->httpClient->post(
                "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'message' => [
                            'topic' => $topic,
                            'notification' => [
                                'title' => $title,
                                'body' => $body,
                            ],
                        ],
                    ],
                ]
            );

            $responseBody = json_decode((string) $response->getBody(), true);

            Log::info('FCM notification sent successfully', [
                'topic' => $topic,
                'name' => $responseBody['name'] ?? null,
            ]);

            return ['success' => true, 'message' => $responseBody['name'] ?? 'Notification sent'];
        } catch (RequestException $e) {
            $errorBody = $e->hasResponse()
                ? (string) $e->getResponse()->getBody()
                : $e->getMessage();

            Log::error('FCM notification failed', [
                'topic' => $topic,
                'error' => $errorBody,
            ]);

            $decoded = json_decode($errorBody, true);
            $errorMessage = $decoded['error']['message'] ?? $e->getMessage();

            return ['success' => false, 'message' => $errorMessage];
        } catch (\Throwable $e) {
            Log::error('FCM unexpected error', ['error' => $e->getMessage()]);

            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Get a short-lived OAuth2 access token using the Firebase service account.
     */
    protected function getAccessToken(): string
    {
        $serviceAccountPath = config('services.fcm.service_account_path');

        if (! $serviceAccountPath || ! file_exists($serviceAccountPath)) {
            throw new \RuntimeException(
                "Firebase service account file not found at: {$serviceAccountPath}"
            );
        }

        $perms = fileperms($serviceAccountPath) & 0777;
        if ($perms & 0044) {
            Log::warning('Firebase service account file has loose permissions. Consider restricting to 0600.', [
                'path' => $serviceAccountPath,
                'permissions' => decoct($perms),
            ]);
        }

        $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($serviceAccount)) {
            throw new \RuntimeException('Invalid Firebase service account JSON file.');
        }

        $now = time();
        $jwtHeader = $this->base64urlEncode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
        $jwtClaims = $this->base64urlEncode(json_encode([
            'iss' => $serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
        ]));

        $unsignedJwt = $jwtHeader . '.' . $jwtClaims;

        $privateKey = $serviceAccount['private_key'];
        $signed = openssl_sign($unsignedJwt, $signature, $privateKey, 'SHA256');

        if ($signed === false) {
            throw new \RuntimeException('Failed to sign the JWT. Verify the private key in the service account file.');
        }

        $signedJwt = $unsignedJwt . '.' . $this->base64urlEncode($signature);

        try {
            $response = $this->httpClient->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'assertion' => $signedJwt,
                ],
            ]);
        } catch (RequestException $e) {
            $errorBody = $e->hasResponse()
                ? (string) $e->getResponse()->getBody()
                : $e->getMessage();
            throw new \RuntimeException('Failed to obtain Firebase access token: ' . $errorBody);
        }

        $tokenData = json_decode((string) $response->getBody(), true);

        if (empty($tokenData['access_token'])) {
            throw new \RuntimeException('Failed to obtain Firebase access token.');
        }

        return $tokenData['access_token'];
    }

    /**
     * Base64url encode a string (URL-safe base64 without padding).
     */
    protected function base64urlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Read project_id from the service account JSON file.
     */
    protected function getProjectId(): string
    {
        $serviceAccountPath = config('services.fcm.service_account_path');

        if (! $serviceAccountPath || ! file_exists($serviceAccountPath)) {
            throw new \RuntimeException(
                "Firebase service account file not found at: {$serviceAccountPath}"
            );
        }

        $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($serviceAccount)) {
            throw new \RuntimeException('Invalid Firebase service account JSON file.');
        }

        if (empty($serviceAccount['project_id'])) {
            throw new \RuntimeException('project_id not found in service account file.');
        }

        return $serviceAccount['project_id'];
    }
}

