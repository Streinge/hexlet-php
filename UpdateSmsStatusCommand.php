<?php

namespace SalesRender\Plugin\Instance\Chat\Commands;

use SalesRender\Plugin\Components\Db\Components\Connector;
use SalesRender\Plugin\Components\Settings\Settings;
use SalesRender\Plugin\Core\Chat\Components\MessageStatusSender\MessageStatusSender;
use SalesRender\Plugin\Core\Commands\MutexCommand;
use SalesRender\Plugin\Instance\Chat\Components\MainSmsApi;
use SalesRender\Plugin\Instance\Chat\Models\MessageReference;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateSmsStatusCommand extends MutexCommand
{
    protected function configure()
    {
        $this->setDescription('Email status tracking');
    }

    public function __construct()
    {
        parent::__construct('email:updateStatus');
        $this->addArgument('limit', InputArgument::OPTIONAL, 'Limit', 3000);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $mutexName = 'updateStatus';
        return $this->withMutex(function () use ($limit, $output) {
            $messageReferences = MessageReference::findById();

            $output->writeln("Total message references found: " . count($messageReferences));

            $settings = Settings::find()->getData();
            $apiKey = $settings->get('maimsms.apikey');

            $emailApi = new MainSmsApi($apiKey);

            /** @var MessageReference $messageReference */
            Connector::setReference($messageReference->getPluginReference());
            $srMessageId = $messageReference->getChat()->getMessage()->getId();

            $status = $emailApi->getStatusEmailbyId($messageReference->getMainSmsEmailId());

            $srStatus = $emailApi->mapStatus($status);

            MessageStatusSender::send($srMessageId, $srStatus);
            if ($status === MessageStatusSender::DELIVERED) {
                $messageReference->delete();
            }

            return Command::SUCCESS;
        }, $mutexName);
    }
}
