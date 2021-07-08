<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Exception;

class FacebookController extends Controller
{
    use ApiTrait;

    private $facebookUrl = 'https://www.facebook.com/';
    private $apiUrl = 'https://graph.facebook.com/';
    private $mopconApiUrl = 'https://graph.facebook.com/v8.0/mopcon';
    /**
     * get newest post from mopcon facebook fanspage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPosts(Request $request)
    {
        $limit = $request->get('limit', 20);
        $facebookPostsKey = 'facebookPosts' . $limit;
        // handle error;
        if ($limit > 100) {
            return $this->returnError('can not access over than 100 posts');
        }
        if (Cache::has($facebookPostsKey)) {
            return $this->returnSuccess('Success get posts', Cache::get($facebookPostsKey));
        }
        try {
            $facebookPosts = json_decode($this->dataProcesser($limit)->getContent(), true)['data'];
            Cache::put($facebookPostsKey, $facebookPosts, 600);
            return $this->returnSuccess('Success get posts', $facebookPosts);
        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
    private function requestFacebookApi(string $url)
    {
        // request facebook api
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);

        // convert response
        $dataJson = json_decode($data, true);

        // handle error; error output
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
            throw new Exception("Token invalid");
        }
        curl_close($ch);
        return $this->returnSuccess('', $dataJson);
    }
    private function dataProcesser(int $limit)
    {
        $token = env('FACEBOOK_TOKEN');
        $fields = ['full_picture', 'message', 'id', 'shares', 'created_time', 'likes{id}', 'permalink_url'];
        $baseUrl = $this->mopconApiUrl . '?fields=published_posts.limit(' . $limit . ')';
        $baseUrl .= urlencode(sprintf('{%s}', implode(',', $fields)));
        $baseUrl .= '&access_token=' . $token;

        try {
            $feedsData = json_decode($this->requestFacebookApi($baseUrl)->getContent(), true);
            // handle error;
            if (!isset($feedsData['data']['published_posts']['data'])) {
                throw new Exception("Not found");
            }
            $postsData = $feedsData['data']['published_posts']['data'];

            foreach ($postsData as $key => $value) {
                $postsData[$key]['shares'] = $value['shares']['count'] ?? 0;
                $postsData[$key]['likes'] = isset($value['likes']['data']) ? count($value['likes']['data']) : 0;
                $postsData[$key]['url'] = $value['permalink_url'];
                $postsData[$key]['created_time'] = strtotime($value['created_time']);
            }
            return $this->returnSuccess('Success get posts', $postsData);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
