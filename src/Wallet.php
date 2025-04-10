<?php
namespace GibraPay;

/**
 * Class Wallet
 * @package GibraPay
 */
class Wallet extends GibraPay {
    /**
     * Wallet constructor.
     * @param string $apiKey
     * @param string|null $walletId
     * @throws \InvalidArgumentException
     */
    public function __construct($apiKey, $walletId = null) {
        parent::__construct($apiKey, $walletId);
    }

    /**
     * Get wallet information
     * @return array
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function get() {
        if (empty($this->walletId)) {
            throw new \InvalidArgumentException('Wallet ID is required to get wallet information');
        }
        return $this->makeRequest('GET', '/v1/wallet/' . $this->walletId);
    }

    /**
     * Create a new wallet
     * @param array $data
     * @return array
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function create($data) {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException('Wallet name is required');
        }
        return $this->makeRequest('POST', '/v1/wallet', $data);
    }
}