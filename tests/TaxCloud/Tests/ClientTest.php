<?php

/**
 * @file
 * Unit Tests
 */

namespace TaxCloud\Tests;

use TaxCloud\Address;
use TaxCloud\CartItem;
use TaxCloud\Client;
use TaxCloud\PingResponse;
use TaxCloud\PingRsp;
use TaxCloud\ResponseMessage;
use TaxCloud\Request\Lookup;
use TaxCloud\Request\Ping;
use TaxCloud\Request\VerifyAddress;
use TaxCloud\VerifiedAddress;

class ClientTest extends \PHPUnit_Framework_TestCase {

  protected $taxcloud;

  // Use a local copy of the WSDL.
  const WSDL = "TaxCloud.wsdl";

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->taxcloud = $this->getMockBuilder('\TaxCloud\Client')
                           ->disableOriginalConstructor()
                           ->getMock();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * Test ::VerifyAddress
   * @todo Test exception handling
   */
  public function testVerifyAddress()
  {
    $client = $this->taxcloud;
    $uspsUserID = '123ABCDE5678';

    $address = new Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20500',
      '0003'
    );

    $verifyAddress = new VerifyAddress($uspsUserID, $address);
    $this->assertEquals($uspsUserID, $verifyAddress->getUspsUserID());

    $result = new \stdClass();
    $result->Address1 = $address->getAddress1();
    $result->City = $address->getCity();
    $result->State = $address->getState();
    $result->Zip5 = $address->getZip5();
    $result->Zip4 = $address->getZip4();
    $result->ErrNumber = 0;

    $expected = new VerifiedAddress;
    $expected->VerifyAddressResult = $result;

    $nousps = clone $verifyAddress;
    $nousps->setUspsUserID('');
    $this->assertEmpty($nousps->getUspsUserID());

    $nouspsResult = new \stdClass();
    $nouspsResult->ErrNumber = '80040b1a';

    $nouspsExpected = new VerifiedAddress;
    $nouspsExpected->VerifyAddressResult = $nouspsResult;

    $map = array(
      array($verifyAddress, $expected),
      array($nousps, $nouspsExpected)
    );

    $client->expects($this->any())
           ->method('VerifyAddress')
           ->will($this->returnValueMap($map));
    $this->assertEquals($expected, $client->VerifyAddress($verifyAddress));
    $this->assertEquals($nouspsExpected, $client->VerifyAddress($nousps));
  }

  /**
   * @todo   Implement testLookupForDate().
   */
  public function testLookupForDate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  public function testLookup()
  {
    $client = $this->taxcloud;
    $cartID = 456;
    $customerID = 123;
    $uspsUserID = '123ABCDE5678';
    $apiLoginID = 'apiLoginID';
    $apiKey = 'apiKey';

    $cartItems = array();
    $cartItem = new CartItem($cartID + 1, 'ABC123', '00000', 12.00, 1);
    $cartItems[] = $cartItem;
    $cartItemShipping = new CartItem($cartID + 2, 'SHIPPING123', 11010, 8.95, 1);
    $cartItems[] = $cartItemShipping;

    $address = new Address(
      '1600 Pennsylvania Ave NW',
      '',
      'Washington',
      'DC',
      '20050',
      '1234'
    );

    $verifyAddress = new VerifyAddress($uspsUserID, $address);

    $verifiedAddress = $client->VerifyAddress($verifyAddress);

    $originAddress = clone $address;

    $destAddress = new Address(
      'PO Box 573',
      '',
      'Clinton',
      'OK',
      '73601',
      ''
    );

    $lookup = new Lookup($apiLoginID, $apiKey, $customerID, $cartID, $cartItems, $originAddress, $destAddress);
    $this->assertEquals($customerID, $lookup->getCustomerID(), 'customerID should be ' . $customerID);
    $this->assertEquals($cartID, $lookup->getCartID(), 'cartID should be ' . $cartID);
    $this->assertEquals($originAddress, $lookup->getOrigin());
    $this->assertInstanceOf('TaxCloud\Address', $lookup->getOrigin());
    $this->assertEquals($destAddress, $lookup->getDestination());
    $this->assertInstanceOf('TaxCloud\Address', $lookup->getDestination());
    $this->assertFalse($lookup->getDeliveredBySeller(), 'deliveredBySeller should be FALSE');

    $lookupResult = new \stdClass();
    $lookupResult->CartID = $cartID;

    $cartItemResponseItems = array();
    $cartItemResponse1 = new \stdClass();
    $cartItemResponse1->CartItemIndex = $cartID + 1;
    $cartItemResponse1->TaxAmount = 0.54;
    $cartItemResponseItems[] = $cartItemResponse1;
    $cartItemResponse2 = new \stdClass();
    $cartItemResponse2->CartItemIndex = $cartID + 2;
    $cartItemResponse2->TaxAmount = 0;
    $cartItemResponseItems[] = $cartItemResponse2;

    $cartItemsResponse = new \stdClass();
    $cartItemsResponse->CartItemsResponse = $cartItemResponseItems;

    $lookupResult->LookupResult = $cartItemsResponse;

    $client->expects($this->any())
           ->method('Lookup')
           ->will($this->returnValue($lookupResult));

    $this->assertEquals($lookupResult, $client->Lookup($lookup));
  }

  /**
   * @todo   Implement testAuthorized().
   */
  public function testAuthorized()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testAuthorizedWithCapture().
   */
  public function testAuthorizedWithCapture()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testCaptured().
   */
  public function testCaptured()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testReturned().
   */
  public function testReturned()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetTICGroups().
   */
  public function testGetTICGroups()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetTICs().
   */
  public function testGetTICs()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetTICsByGroup().
   */
  public function testGetTICsByGroup()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testAddExemptCertificate().
   */
  public function testAddExemptCertificate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testDeleteExemptCertificate().
   */
  public function testDeleteExemptCertificate()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  /**
   * @todo   Implement testGetExemptCertificates().
   */
  public function testGetExemptCertificates()
  {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
  }

  public function testPing()
  {
    $apiLoginID = 'apiLoginID';
    $apiKey = 'apiKey';

    $ping = new Ping($apiLoginID, $apiKey);

    $pingBad = new Ping('xxx', 'xxx');

    $pingResult = new PingRsp();
    $pingResult->setResponseType = 'OK';
    $pingResult->setMessages = '';

    $pingResponse = new PingResponse($pingResult);
//    $pingResponse->PingResult = $pingResult;

    $pingResultBad = new PingRsp();
    $pingResultBad->setResponseType = 'OK';
    $pingResultBad->setMessages = new \stdClass();

    $pingResultBadMessage = new ResponseMessage();
//    $pingResultBadMessage->ResponseType = 'Error';
//    $pingResultBadMessage->Message = 'Invalid apiLoginID and/or apiKey';

    $pingResultBad->ResponseMessage = $pingResultBadMessage;

    $pingResponseBad = new PingResponse($pingResult);
//    $pingResponseBad->PingResult = $pingResult;

    $map = array(
      array($ping, $pingResponse),
      array($pingBad, $pingResponseBad)
    );

    $client = $this->taxcloud;
    $client->expects($this->any())
           ->method('Ping')
           ->will($this->returnValueMap($map));

    $this->assertEquals($pingResponse, $client->Ping($ping));
    $this->assertEquals($pingResponseBad, $client->Ping($pingBad));
  }
}
