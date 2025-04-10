<?php
namespace GibraPay;

/**
 * Class Withdraw
 * @package GibraPay
 */
class Withdraw extends GibraPay {
    protected $amount;
    protected $phoneNumber;

    /**
     * Withdraw constructor.
     * @param string $apiKey
     * @param string $walletId
     * @param float $amount
     * @param string $phoneNumber
     * @throws \InvalidArgumentException
     */
    public function __construct($apiKey, $walletId, $amount, $phoneNumber) {
        parent::__construct($apiKey, $walletId);

        if (empty($walletId)) {
            throw new \InvalidArgumentException('Wallet ID is required');
        }

        if (!is_numeric($amount) || $amount <= 0) {
            throw new \InvalidArgumentException('Amount must be a positive number');
        }

        if (empty($phoneNumber)) {
            throw new \InvalidArgumentException('Phone number is required');
        }

        $this->amount = $amount;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Execute the withdrawal
     * @return array
     * @throws \Exception
     */
    public function execute() {
        $data = [
            'wallet_id' => $this->walletId,
            'amount' => $this->amount,
            'phone_number' => $this->phoneNumber
        ];
        
        return $this->makeRequest('POST', '/v1/withdraw', $data);
    }
}