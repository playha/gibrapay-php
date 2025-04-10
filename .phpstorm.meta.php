<?php

namespace PHPSTORM_META {
    override(\GuzzleHttp\Client::class, map([
        '' => '@',
    ]));
    
    override(\GuzzleHttp\Exception\RequestException::class, map([
        '' => '@',
    ]));
} 