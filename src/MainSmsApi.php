<?php

namespace Hexlet\Php;

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use SalesRender\Plugin\Core\Chat\Components\MessageStatusSender\MessageStatusSender;

class MainSmsApi
{
    private Client $client;
    private string $email;
    private string $password;
    private string $sender;

    public function __construct(string $email, string $password, string $sender)
    {
        $this->email = $email;
        $this->password = $password;
        $this->sender = $sender;
        $this->client = new Client(
            ['http_errors' => false]
        );
    }

    private function authLogin(): ?string
    {
        $authData = [
            'email' => $this->email,
            'password' => $this->password,
            'remember' => true
        ];
        https://api.mainsms.ru/v1
        $url = 'https://my.zorra.com/api/v2/auth/login';

        $response = $this->makePostRequest($url, $authData);

        if ($this->isSuccessResponse($response)) {
            $responseData = json_decode($response->getBody(), true);
            return $responseData['access_token'];
        } else {
            return json_encode(["error" => "Unauthorized"]);
        }
    }

    public function sendSms(string $sender, string $mailing, string $body, string $recipient): array
    {
        $messageData = [
            'sender' => $sender,
            'mailing' => $mailing,
            'body' => $body,
            'recipient' => $recipient
        ];

        $url = 'https://module.sms.zorra.com/api/v1/mailings';

        return $this->createAuthenticatedRequest($url, $messageData);
    }

    public function getFullSmsMessages($startDateRange, $endDateRange): array
    {
        $sender = [
            "mailing_name" => $this->sender,
            "start" => $startDateRange,
            "end" => $endDateRange,
            "current_page" => 1
        ];

        $url = 'https://module.sms.zorra.com/api/v1/stats/messages/detailed';

        $result = [];

        do {
            $response = $this->createAuthenticatedRequest($url, (array)json_encode($sender), 'GET');

            $data = json_decode($response, true);

            if (!isset($data['data'])) {
                break;
            }

            foreach ($data['data'] as $smsData) {
                $result[$smsData['mailing_id']] = $smsData['status'];
            }
            $sender['current_page']++;

        } while ($data['meta']['current_page'] < $data['meta']['total_pages']);

        return $result;
    }

    private function createAuthenticatedRequest(string $url, array $data, string $method = 'POST'): array
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken()
            ]
        ];

        if ($method === 'POST') {
            $options['json'] = $data;
        } else {
            $options['query'] = $data;
        }

        $response = $this->client->request($method, $url, $options);
        return json_decode($response->getBody()->getContents(), true);
    }

    private function makePostRequest(string $url, array $data): ResponseInterface
    {
        return $this->client->post($url, [
            'form_params' => $data
        ]);
    }

    private function isSuccessResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() === 200;
    }
    /*
    public function mapStatus(string $zorraSmsStatus): ?string
    {
        $statusMap = [
            'pending' => MessageStatusSender::SENT,             //В очереди на отправление
            'accepted' => MessageStatusSender::SENT,            //Принято к отправлению
            'sent' => MessageStatusSender::SENT,                //Ожидает
            'processing' => MessageStatusSender::SENT,          //Запланировано
            'delivered' => MessageStatusSender::DELIVERED,      //Доставлено
            'failed' => MessageStatusSender::SENT,              //Отменено
            'not_delivered' => MessageStatusSender::ERROR,      //Отклонено
            'rejected' => MessageStatusSender::SENT,            //Отклонено
        ];

        return $statusMap[$zorraSmsStatus];
    }
    */
    private function getAccessToken(): string
    {
        return $this->authLogin();
    }
}

$user = new MainSmsApi('email', 'user', 'password');

var_dump($user);
