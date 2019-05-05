<?php

namespace Whereabouts;

use GuzzleHttp;

class Client
{

    public static $API_URL = "https://api.whereabouts.blue";
    public static $VERIFY_SSL = true;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var GuzzleHttp\Client|null
     */
    protected $httpClient;

    /**
     * @param string $addressId
     *
     * @return Model\Address
     *
     * @throws Exception\InvalidApiKey
     * @throws Exception\InvalidFormat
     * @throws Exception\NoSuchAddress
     * @throws Exception\QuotaExceeded
     * @throws Exception\Unexpected
     * @throws Exception\CountryNotSupported
     */
    public function getAddressById($addressId)
    {
        try {
            $json = $this->get(
                sprintf(
                    '%s/v1/address/%s',
                    static::$API_URL,
                    $addressId
                )
            );
        } catch (GuzzleHttp\Exception\ClientException $e) {
            if ($e->getResponse() !== null && $e->getResponse()->getStatusCode() === 404) {
                throw new Exception\NoSuchAddress($addressId);
            }

            throw Exception\Unexpected::fromPrevious($e);
        }

        return Mapper\Address::fromJson($json);
    }

    /**
     * @param string $countryCode
     * @param string $postalCode
     * @param null   $houseNumber
     * @param null   $houseNumberAddition
     * @param null   $limit
     * @param int    $offset
     *
     * @return Model\AddressResult
     *
     * @throws Exception\CountryNotSupported
     * @throws Exception\InvalidApiKey
     * @throws Exception\InvalidFormat
     * @throws Exception\NoResult
     * @throws Exception\QuotaExceeded
     * @throws Exception\Unexpected
     */
    public function findAddress(
        $countryCode,
        $postalCode,
        $houseNumber = null,
        $houseNumberAddition = null,
        $limit = null,
        $offset = 0
    ) {
        $queryParams = [
            'offset' => $offset,
        ];

        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }

        $urlHouseNumber = null;
        if ($houseNumber !== null) {
            $urlHouseNumber = sprintf(
                '%d%s%s',
                $houseNumber,
                $houseNumberAddition !== null ? '-' : '',
                $houseNumberAddition
            );
        }

        $urlParts = array_filter(
            [
                $countryCode,
                $postalCode,
                $urlHouseNumber
            ]
        );

        try {
            $json = $this->get(
                sprintf(
                    '%s/v1/address/%s',
                    static::$API_URL,
                    implode('/', $urlParts)
                ),
                $queryParams
            );
        } catch (GuzzleHttp\Exception\ClientException $e) {
            if ($e->getResponse() !== null && $e->getResponse()->getStatusCode() === 404) {
                throw new Exception\NoResult();
            }

            throw Exception\Unexpected::fromPrevious($e);
        }

        if ($houseNumberAddition !== null) {
            return new Model\AddressResult(
                [
                    Mapper\Address::fromJson($json),
                ],
                $limit ?: 1,
                0,
                1
            );
        }

        return Mapper\AddressResult::fromJson($json);
    }

    /**
     * @param string $url
     * @param array  $query
     *
     * @return mixed
     *
     * @throws Exception\CountryNotSupported
     * @throws Exception\InvalidFormat
     * @throws Exception\InvalidApiKey
     * @throws Exception\QuotaExceeded
     * @throws Exception\Unexpected
     */
    private function get($url, array $query = [])
    {
        $client = $this->getHttpClient();

        try {
            $response = $client->request(
                'GET',
                sprintf(
                    '%s?%s',
                    $url,
                    http_build_query($query)
                )
            );
        } catch (GuzzleHttp\Exception\ClientException $clientException) {
            if ($clientException->getResponse() !== null) {
                $response = $clientException->getResponse();

                if ($response->getStatusCode() === 400) {
                    throw new Exception\InvalidFormat();
                }

                if ($response->getStatusCode() === 401) {
                    throw new Exception\InvalidApiKey();
                }

                if ($response->getStatusCode() === 402) {
                    throw new Exception\QuotaExceeded();
                }
            }

            throw $clientException;
        } catch (GuzzleHttp\Exception\ServerException $serverException) {
            if ($serverException->getResponse() !== null && $serverException->getResponse()->getStatusCode() === 501) {
                throw new Exception\CountryNotSupported();
            }

            throw Exception\Unexpected::fromPrevious($serverException);
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            throw Exception\Unexpected::fromPrevious($e);
        }

        $responseBody = $response->getBody()->getContents();

        $decodedBody = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw Exception\Unexpected::fromLastJsonError();
        }

        return $decodedBody;
    }

    /**
     * @return GuzzleHttp\Client
     */
    private function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new GuzzleHttp\Client(
                [
                    GuzzleHttp\RequestOptions::VERIFY  => static::$VERIFY_SSL,
                    GuzzleHttp\RequestOptions::HEADERS => [
                        'User-Agent'        => 'whereabouts-php/client-1.0',
                        'Accept'            => 'application/json',
                        'X-Whereabouts-Key' => $this->apiKey,
                    ],
                ]
            );
        }

        return $this->httpClient;
    }
}