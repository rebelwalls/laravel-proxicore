<?php

declare(strict_types=1);

namespace RebelWalls\LaravelProxicore\Tests\Unit;

use Illuminate\Support\Facades\Http;
use RebelWalls\LaravelProxicore\Api\ProxicoreApiResponse;
use RebelWalls\LaravelProxicore\Calls\ProxicoreGetPaymentStatusCall;
use RebelWalls\LaravelProxicore\Tests\TestCase;

class PaymentStatusTest extends TestCase
{
    /**
     * @return void
     */
    public function testCanProcessTheHttpResponse()
    {
        Http::fake([
            'api.test/*' => Http::response(['status' => 200, 'payload' => []], 200)
        ]);
        $paymentStatusCall = new ProxicoreGetPaymentStatusCall();

        $this->assertInstanceOf(ProxicoreApiResponse::class, $paymentStatusCall->getPaymentStatus('1'));
    }
}
