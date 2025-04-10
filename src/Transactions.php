<?php
namespace GibraPay;

/**
 * Class Transactions
 * @package GibraPay
 */
class Transactions extends GibraPay {
    /**
     * Transactions constructor.
     * @param string $apiKey
     * @param string|null $walletId
     * @throws \InvalidArgumentException
     */
    public function __construct($apiKey, $walletId = null) {
        parent::__construct($apiKey, $walletId);
    }

    /**
     * Get all transactions for a wallet
     * @return array
     * @throws \Exception
     */
    public function get() {
        if (empty($this->walletId)) {
            throw new \InvalidArgumentException('Wallet ID is required to get transactions');
        }
        return $this->makeRequest('GET', '/v1/transactions/' . $this->walletId);
    }

    /**
     * Get a specific transaction by ID
     * @param string $transactionId
     * @return array
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function getById($transactionId) {
        if (empty($this->walletId)) {
            throw new \InvalidArgumentException('Wallet ID is required to get transaction details');
        }
        if (empty($transactionId)) {
            throw new \InvalidArgumentException('Transaction ID is required');
        }
        return $this->makeRequest('GET', '/v1/transactions/' . $this->walletId . '/' . $transactionId);
    }
}