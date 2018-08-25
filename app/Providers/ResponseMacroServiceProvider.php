<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Resources\Json\Resource;
use Symfony\Component\HttpFoundation\Response as ResponseHelper;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function ($data, $status = ResponseHelper::HTTP_OK, $message = null) {
            if (is_object($data)) {
                if (method_exists($data, 'to_array')) {
                    $data = $data->to_array();
                } elseif($data instanceOf Resource) {
                    $data = $data->toArray(request());
                } elseif (method_exists($data, 'toArray')) {
                    $data = $data->toArray(request());
                } else {
                    $data = (array) $data;
                }
            }

            return response()->json([
                'success' => $status === ResponseHelper::HTTP_OK,
                'message' => $message ?? config("status-messages.$status", "unknown"),
                'status' => $status,
                'data' => $data,
                'timetaken' => microtime(true) - APP_START
            ], $status)->header('X-Powered-By', 'Coffee');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
