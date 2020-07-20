<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\HostedNumbers;

use Twilio\ListResource;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class HostedNumberOrderList extends ListResource {
    /**
     * Construct the HostedNumberOrderList
     * 
     * @param Version $version Version that contains the resource
     * @return \Twilio\Rest\Preview\HostedNumbers\HostedNumberOrderList 
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array();

        $this->uri = '/HostedNumberOrders';
    }

    /**
     * Streams HostedNumberOrderInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     * 
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream($options = array(), $limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads HostedNumberOrderInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     * 
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return HostedNumberOrderInstance[] Array of results
     */
    public function read($options = array(), $limit = null, $pageSize = null) {
        return iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of HostedNumberOrderInstance records from the API.
     * Request is executed immediately
     * 
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of HostedNumberOrderInstance
     */
    public function page($options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $options = new Values($options);
        $params = Values::of(array(
            'Status' => $options['status'],
            'PhoneNumber' => $options['phoneNumber'],
            'IncomingPhoneNumberSid' => $options['incomingPhoneNumberSid'],
            'FriendlyName' => $options['friendlyName'],
            'UniqueName' => $options['uniqueName'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new HostedNumberOrderPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of HostedNumberOrderInstance records from the API.
     * Request is executed immediately
     * 
     * @param string $targetUrl API-generated URL for the requested results page
     * @return \Twilio\Page Page of HostedNumberOrderInstance
     */
    public function getPage($targetUrl) {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new HostedNumberOrderPage($this->version, $response, $this->solution);
    }

    /**
     * Create a new HostedNumberOrderInstance
     * 
     * @param string $phoneNumber An E164 formatted phone number.
     * @param boolean $smsCapability Specify SMS capability to host.
     * @param array|Options $options Optional Arguments
     * @return HostedNumberOrderInstance Newly created HostedNumberOrderInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create($phoneNumber, $smsCapability, $options = array()) {
        $options = new Values($options);

        $data = Values::of(array(
            'PhoneNumber' => $phoneNumber,
            'SmsCapability' => Serialize::booleanToString($smsCapability),
            'AccountSid' => $options['accountSid'],
            'FriendlyName' => $options['friendlyName'],
            'UniqueName' => $options['uniqueName'],
            'CcEmails' => Serialize::map($options['ccEmails'], function($e) { return $e; }),
            'SmsUrl' => $options['smsUrl'],
            'SmsMethod' => $options['smsMethod'],
            'SmsFallbackUrl' => $options['smsFallbackUrl'],
            'SmsFallbackMethod' => $options['smsFallbackMethod'],
            'StatusCallbackUrl' => $options['statusCallbackUrl'],
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
            'SmsApplicationSid' => $options['smsApplicationSid'],
            'AddressSid' => $options['addressSid'],
            'Email' => $options['email'],
            'VerificationType' => $options['verificationType'],
            'VerificationDocumentSid' => $options['verificationDocumentSid'],
        ));

        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new HostedNumberOrderInstance($this->version, $payload);
    }

    /**
     * Constructs a HostedNumberOrderContext
     * 
     * @param string $sid HostedNumberOrder sid.
     * @return \Twilio\Rest\Preview\HostedNumbers\HostedNumberOrderContext 
     */
    public function getContext($sid) {
        return new HostedNumberOrderContext($this->version, $sid);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Preview.HostedNumbers.HostedNumberOrderList]';
    }
}