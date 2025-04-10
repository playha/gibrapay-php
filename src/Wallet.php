<?php
namespace GibraPay;

class Wallet extends GibraPay {
    public function __construct($apiKey, $walletId = null) {
        parent::__construct($apiKey, $walletId);
    }

    public function get() {
        return $this->makeRequest('GET', '/v1/wallet/' . $this->walletId);
    }

    public function create($data) {
        return $this->makeRequest('POST', '/v1/wallet', $data);
    }
}