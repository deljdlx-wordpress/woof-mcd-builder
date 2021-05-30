<?php

namespace WoofSchemaBuilder;

use Woof\RestApi as WoofRestApi;
use WP_REST_Request;

class RestAPI extends WoofRestApi
{

    protected $namespace = 'woof-shema-builder/v1';



    public function register()
    {
        parent::register();
    }


    public function registerRoutes()
    {

        $this->addRoute(
            'GET',
            '/about',
            [$this, 'about'],
            true
        );

        $this->addRoute(
            'POST',
            '/save',
            [$this, 'save'],
            true
        );

        $this->addRoute(
            'GET',
            '/save',
            [$this, 'saveHowto'],
            true
        );
    }

    public function about() {
        return [
            'version' => '1.0',
            'name' => 'caniche'
        ];
    }

    public function saveHowto()
    {
        return 'hello world';
    }


    public function save(WP_REST_Request $request)
    {
        $currentUserId = $this->getUserIdFromNonce($request);

        if($currentUserId) {
            $data = $this->getPostData();

            if($data['postId']) {
                $post = $this->update($data);
            }
            else {
                $post = $this->insert($data);
            }


            return $post;
        }
        else {
            return [
                'status' => 'error',
                'message' => 'user not logged',
                'nonce' => $request->get_header('X-WP-Nonce'),
            ];
        }
    }

    public function update($data)
    {
        $xml = $data['xml'];
        return $this->updatePost(
            $data['postId'],
            [
                'post_content' => $xml,
                'post_title' => $data['title'],
                'post_excerpt' => $data['excerpt'],
            ]
        );
    }

    protected function insert($data)
    {
        $xml = $data['xml'];
        $this->createPost('woof-schema', [
            'post_title' => $data['title'],
            'post_excerpt' => $data['excerpt'],
            'post_content' => $xml
        ]);
    }
}
