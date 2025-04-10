# Biblioteca PHP GibraPay

Biblioteca oficial em PHP para a API GibraPay. Esta biblioteca fornece uma interface simples e intuitiva para interagir com os serviços de pagamento da GibraPay.

## Requisitos

- PHP 7.3 ou superior
- GuzzleHttp/Guzzle 7.0 ou superior

## Instalação

Você pode instalar a biblioteca usando o Composer:

```bash
composer require gibrapay/gibrapay-php
```

## Configuração

Para usar a API GibraPay, você precisará da sua chave de API e opcionalmente um ID de carteira. Você pode obter estes dados no site da GibraPay.

## Como Usar

### Inicializar o Cliente

```php
use GibraPay\GibraPay;

$apiKey = 'sua-chave-api';
$walletId = 'seu-id-carteira'; // Opcional

```

### Transferir Dinheiro

```php
use GibraPay\Transfer;

$transfer = new Transfer($apiKey, $walletId, 1000, '86xxxx');
$result = $transfer->execute();
```

### Sacar Dinheiro

```php
use GibraPay\Withdraw;

$withdraw = new Withdraw($apiKey, $walletId, 1000, '85xxxxx');
$result = $withdraw->execute();
```

### Visualizar Transações

```php
use GibraPay\Transactions;

$transactions = new Transactions($apiKey, $walletId);
$historicoTransacoes = $transactions->get();
```

## Tratamento de Erros

A biblioteca lança exceções quando as requisições à API falham. É recomendado envolver as chamadas da API em blocos try-catch:

```php
try {
    $result = $transfer->execute();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
```

## Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para enviar um Pull Request.

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo LICENSE para detalhes.
