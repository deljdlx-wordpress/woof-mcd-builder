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
        // IMPORTANT nonce rest call validation
        $nonce = $request->get_header('X-WP-Nonce');
        wp_verify_nonce($nonce, 'wp_rest');

        $currentUserId = get_current_user_id();

        // NOTICE check if _wpnonce was sent in POST/GET paramter
        // $check = check_ajax_referer( 'wp_rest', '_wpnonce', false );


        if($currentUserId) {
            $data = $this->getPostData();
            $xml = $data['xml'];
                $this->createPost('woof-schema', [
                'title' => 'test schema',
                'content' => $xml
            ]);
            return $data;
        }
        else {
            return [
                'status' => 'error',
                'message' => 'user not logged',
                'nonce' => $request->get_header('X-WP-Nonce'),
            ];
        }
    }
}
