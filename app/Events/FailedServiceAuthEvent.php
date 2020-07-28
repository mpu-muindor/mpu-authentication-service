<?php

namespace App\Events;

use App\Models\Service;
use App\Models\ServiceLog;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;

class FailedServiceAuthEvent
{
    use Dispatchable;

    /**
     * @var Service
     */
    private $service;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var bool
     */
    private $result;

    /**
     * FailedServiceAuthEvent constructor.
     *
     * @param  Service|null  $service
     * @param  Request  $request
     * @param  bool  $result
     */
    public function __construct($service, Request $request, bool $result)
    {
        $this->service = $service;
        $this->request = $request;
        $this->result = $result;
    }

    public function log()
    {
        if ($this->service) {
            $this->service->logs()->create(
                [
                    'remote_address' => $this->request->ip(),
                    'request_target' => $this->request->path(),
                    'token' => $this->request->get('api_token'),
                    'params' => $this->request->all(),
                    'result' => $this->result
                ]
            );

            return;
        }

        (new ServiceLog(
            [
                'remote_address' => $this->request->ip(),
                'request_target' => $this->request->path(),
                'token' => $this->request->get('api_token'),
                'params' => $this->request->all(),
                'result' => $this->result
            ]))->save();
    }
}
