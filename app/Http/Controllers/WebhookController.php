<?php

namespace App\Http\Controllers;


class WebhookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function serve($request)
    {
        $closure=app(\GTAI\Webhook\ActionMapper::class)->getHandler($request->result->action);
        return $closure($request);
    }
}
