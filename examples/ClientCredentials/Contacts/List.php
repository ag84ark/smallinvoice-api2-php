<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;

    $provider = require_once __DIR__ . '/../../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        $hasMore = true;
        $listParameters = (new ListParameters())->setMaxLimit();

        do {
            $responseItems = $contacts->list($listParameters)->getItems();

            foreach ($responseItems as $item) {
                print_r($item);
            }

            $listParameters->setNextOffset();
        } while ($responseItems->hasNext());
    } catch (Exception $e) {
        print_r($e->getMessage());
    }