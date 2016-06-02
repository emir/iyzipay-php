<?php

namespace Iyzipay\Tests\Request;

use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Request\CreateBasicPaymentRequest;
use Iyzipay\Tests\TestCase;

class CreateBasicPaymentRequestTest extends TestCase
{
    public function test_should_get_json_object()
    {
        $request = new CreateBasicPaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId("123456789");
        $request->setBuyerEmail("email@email.com");
        $request->setBuyerId("B2323");
        $request->setBuyerIp("85.34.78.112");
        $request->setConnectorName("connector name");
        $request->setInstallment(1);
        $request->setPaidPrice("1");
        $request->setPrice("1");
        $request->setCurrency(Currency::TL);

        $jsonObject = $request->getJsonObject();

        $this->assertEquals(Locale::TR, $jsonObject["locale"]);
        $this->assertEquals("123456789", $jsonObject["conversationId"]);
        $this->assertEquals("email@email.com", $jsonObject["buyerEmail"]);
        $this->assertEquals("B2323", $jsonObject["buyerId"]);
        $this->assertEquals("85.34.78.112", $jsonObject["buyerIp"]);
        $this->assertEquals("connector name", $jsonObject["connectorName"]);
        $this->assertEquals("1", $jsonObject["installment"]);
        $this->assertEquals("1", $jsonObject["paidPrice"]);
        $this->assertEquals("1", $jsonObject["price"]);
        $this->assertEquals("TRY", $jsonObject["currency"]);
    }

    public function test_should_convert_to_pki_request_string()
    {
        $request = new CreateBasicPaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId("123456789");
        $request->setBuyerEmail("email@email.com");
        $request->setBuyerId("B2323");
        $request->setBuyerIp("85.34.78.112");
        $request->setConnectorName("connector name");
        $request->setInstallment(1);
        $request->setPaidPrice("1");
        $request->setPrice("1");
        $request->setCurrency(Currency::TL);

        $str = "[locale=tr," .
            "conversationId=123456789," .
            "price=1.0," .
            "paidPrice=1.0," .
            "installment=1," .
            "buyerEmail=email@email.com," .
            "buyerId=B2323," .
            "buyerIp=85.34.78.112," .
            "currency=TRY," .
            "connectorName=connector name]";

        $this->assertEquals($str, $request->toPKIRequestString());
    }

    public function test_should_get_json_string()
    {
        $request = new CreateBasicPaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId("123456789");
        $request->setBuyerEmail("email@email.com");
        $request->setBuyerId("B2323");
        $request->setBuyerIp("85.34.78.112");
        $request->setConnectorName("connector name");
        $request->setInstallment(1);
        $request->setPaidPrice("1");
        $request->setPrice("1");
        $request->setCurrency(Currency::TL);

        $json = '
            {
                "locale":"tr",
                "conversationId":"123456789",
                "price":"1.0",
                "paidPrice":"1.0",
                "installment":"1",
                "buyerEmail":"email@email.com",
                "buyerId":"B2323",
                "buyerIp":"85.34.78.112",
                "currency":"TRY",
                "connectorName":"connector name"
            }';

        $this->assertJson($request->toJsonString());
        $this->assertJsonStringEqualsJsonString($json, $request->toJsonString());
    }
}