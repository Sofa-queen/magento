<?php
namespace Shellpea\GuestWishlist\Cron;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Wishlist\Model\Wishlist;

class DeleteGuestWishlist
{

    protected $logger;

    protected $date;

    private $wishlist;

    protected $scopeConfig;

    const XML_PATH_GUESTWISHLIST_TIME = 'guest_wishlist/delete_wishlist/time';

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ResourceConnection $connection,
        LoggerInterface $logger,
        Wishlist $wishlist,
        DateTime $date
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->connection = $connection->getConnection();
        $this->wishlist = $wishlist;
        $this->logger = $logger;
        $this->date = $date;
    }

    public function execute()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $time = $this->scopeConfig->getValue(self::XML_PATH_GUESTWISHLIST_TIME, $storeScope);

        $select = $this->connection->select()->from(
            ['wishlist']
        )->where(
            'customer_id = 0'
        );
        $data = $this->connection->fetchCol($select);
        $removed = [];
        foreach ($data as $value) {
                $guest_wishlist = $this->wishlist->load($value);
                $updated_at = $guest_wishlist->getUpdatedAt();

                $date = $this->date->gmtDate();
                $date1 = strtotime($date);
                $date2 = strtotime($updated_at);
                $diff = abs($date1 - $date2);
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                
            if ($days >= $time) {
                $removed[] = $value;
                $guest_wishlist->delete();
            }
        }
        $this->logger->log(100, print_r($removed, true));
    }
}
