<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RedditAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
    $clientID = 'fCeBZUIZQHr7QAXiuqUcmA';
    $clientSecret = 'tJmhmQZraM9XRyvVt9aq9XbXixT8lw';

// Make a request to Reddit's authorization server to obtain an access token
$response = Http::asForm()->post('https://www.reddit.com/api/v1/access_token', [
    'grant_type' => 'password',
    'username' => 'Due-Chemical-6024',
    'password' => 'YPMakanda881013',
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    
]);


// Extract access token from the response
$accessToken = "eyJhbGciOiJSUzI1NiIsImtpZCI6IlNIQTI1NjpzS3dsMnlsV0VtMjVmcXhwTU40cWY4MXE2OWFFdWFyMnpLMUdhVGxjdWNZIiwidHlwIjoiSldUIn0.eyJzdWIiOiJsb2lkIiwiZXhwIjoxNzE1OTM3NzI4LjY1NTI5MywiaWF0IjoxNzE1ODUxMzI4LjY1NTI5MiwianRpIjoiQnhINjh2VEh1WUR2dV9seDRkMkZ6Zkx3Vm9qb2FBIiwiY2lkIjoiZkNlQlpVSVpRSHI3UUFYaXVxVWNtQSIsImxpZCI6InQyXzEwZ3k3ZjU0Zm0iLCJsY2EiOjE3MTU4NDc0NjQyMDEsInNjcCI6ImVKeUtWdEpTaWdVRUFBRF9fd056QVNjIiwiZmxvIjo2fQ.mlvie2jZAO_7npRWtvqiWCqxBCbxSinLIki13kvKRAFRtK-5Vpl5dVDiD0e3r0MyDxfT-g-udTssEfRfx4YBwTDmtTgyCGeBuQAjpoMeObmTprlRuEEgVtMzopMDybTs_p02nnRAEg00Z8D2k95E6tmNi7f20wrwDfBcUc8d7Dx-IJANZBud7rcaJRy_YLyloIcTHwIsOk58EGxrzHVYfYZhDCsr6AW3J5hkhHX3n1GozB7aFwBey9glr1jAejydnl7ht_n9z6A49NMOiMA-Rp7kRmdW-uQP3bcte6efgzEnmxiCytk-0mIleOp3W6upEC5yrqa1ZxPlXZkUHBKGiw";
   

// Use the access token in your API requests to authenticate with Reddit's API
$responses = Http::withHeaders([
    'Authorization' => 'Bearer ' . $accessToken,
])->get('https://oauth.reddit.com/api/v1/me');

dd($responses );
$response2 = Http::withToken($accessToken)->post('https://oauth.reddit.com/api/submit', [
    'title' => 'testing',
    'text' => 'just test',
    'sr' => 'programming', // Specify the subreddit where the post should be created
]);
dd($response2);

//         $clientID = '****'; // app client id
// $clientSecret = '****'; // app secret 
// $redditUsername = '****'; // reddit username 
// $redditPassword = '****'; // reddit password

// $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';

// $title = '****'; // post title
// $r = '****'; // subreddit to post to 
// $kind = '****'; // post type
// $url = 'http://example.com'; // url to post
    
// $ch = curl_init('https://www.reddit.com/api/v1/access_token?grant_type=password&username=' . $redditUsername . '&password=' . $redditPassword . '');
// curl_setopt($ch, CURLOPT_USERAGENT, $agent);
// curl_setopt($ch, CURLOPT_USERPWD, '' . $clientID . ':' . $clientSecret . '');
// curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $return = curl_exec($ch);
// curl_close($ch);

// $token = json_decode($return, true);

// print_r($token);

// $ch = curl_init('https://oauth.reddit.com/api/submit?kind=' . $link . '&sr=' . $r . '&title=' . $title . '&r=' . $r . '&url='.urlencode($url));
// curl_setopt($ch, CURLOPT_USERAGENT, $agent);
// curl_setopt($ch, CURLOPT_USERPWD, '' . $clientID . ':' . $clientSecret . '');
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $token['access_token'] . ''));
// curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $return = curl_exec($ch);
// curl_close($ch);
// $response = json_decode($return, true);
// echo '<br><br>';
// print_r($response);

    }

    public function getPosts($subreddit)
    {
        $response = Http::get("https://www.reddit.com/r/$subreddit.json");

        if ($response->ok()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Failed to fetch data from Reddit API'], $response->status());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
