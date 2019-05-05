<?php

namespace Whereabouts\Model;

use JsonSerializable;

class AddressResult implements JsonSerializable
{

    /**
     * @var Address[]
     */
    private $addresses;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $total;

    /**
     * @param Address[] $addresses
     * @param int       $limit
     * @param int       $offset
     * @param int       $total
     */
    public function __construct(array $addresses, $limit, $offset, $total)
    {
        $this->addresses = $addresses;
        $this->limit     = $limit;
        $this->offset    = $offset;
        $this->total     = $total;
    }

    /**
     * @return Address[]
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'addresses'  => $this->addresses,
            'pagination' => [
                'limit'  => $this->limit,
                'offset' => $this->offset,
                'total'  => $this->total,
            ]
        ];
    }
}