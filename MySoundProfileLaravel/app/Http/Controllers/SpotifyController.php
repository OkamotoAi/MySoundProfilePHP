<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use App\Models\Music;
use Illuminate\Support\Facades\Log;

class SpotifyController extends Controller
{
    public function login()
    {
        $clientId = env('SPOTIFY_CLIENT_ID');
        $clientSecret = env('SPOTIFY_CLIENT_SECRET');
        $redirectUri = env('REDIRECT_URI');

        Log::info('Spotify Auth Debug', [
            'client_id' => $clientId ? substr($clientId, 0, 5) . '...' : 'NULL',
            'client_secret_set' => !empty($clientSecret),
            'redirect_uri' => $redirectUri
        ]);

        $session = new Session(
            $clientId,
            $clientSecret,
            $redirectUri
        );

        $options = [
            'scope' => [
                'playlist-read-private',
                'playlist-read-collaborative',
                'user-library-read'
            ],
        ];

        $url = $session->getAuthorizeUrl($options);
        Log::info('Generated Auth URL', ['url' => $url]);

        return redirect($url);
    }

    public function callback(Request $request)
    {
        $session = new Session(
            env('SPOTIFY_CLIENT_ID'),
            env('SPOTIFY_CLIENT_SECRET'),
            env('REDIRECT_URI')
        );

        try {
            $session->requestAccessToken($request->code);
            $accessToken = $session->getAccessToken();
            Log::info('Access Token obtained successfully.');
        } catch (\Exception $e) {
            Log::error('Token Request Failed: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Authentication failed.');
        }

        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        // Fetch tracks
        try {
            $tracks = $api->getMySavedTracks(['limit' => 50]);
            Log::info('Fetched ' . count($tracks->items) . ' tracks from Spotify.');
        } catch (\Exception $e) {
            Log::error('Failed to fetch tracks: ' . $e->getMessage());
            return redirect()->route('dashboard');
        }

        // Prepare IDs for batch fetching
        $trackData = [];
        $ids = [];

        foreach ($tracks->items as $item) {
            $track = $item->track;
            if (!$track || !$track->id) continue;
            
            $ids[] = $track->id;
            $trackData[$track->id] = [
                'music_id' => $track->id,
                'name' => $track->name,
                'artist' => $track->artists[0]->name ?? 'Unknown',
                'popularity' => $track->popularity,
            ];
        }

        // Note: Audio Features API is deprecated as of Nov 2024 for new apps.
        // Skipping feature fetching to avoid 403 errors.
        foreach ($trackData as $id => $data) {
             Music::updateOrCreate(
                ['music_id' => $id],
                $data // Contains name, artist, popularity
            );
        }
        Log::info('Database update using basic track info completed.');
        
        /* Deprecated Logic Removed
        // Fetch Audio Features in Batch
        if (!empty($ids)) {
            // ... (Removed to prevent 403)
        }
        */

        return redirect()->route('dashboard')->with('status', 'Tracks synced successfully (Audio Features unavailable due to Spotify API deprecation).');
    }
}
