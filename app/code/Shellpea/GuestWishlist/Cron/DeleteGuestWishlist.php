<?php
namespace Shellpea\GuestWishlist\Cron;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Stdlib\DateTime\DateTime;

class DeleteGuestWishlist
{
    protected $date;

    protected $scopeConfig;

    const XML_PATH_GUESTWISHLIST_TIME = 'guest_wishlist/delete_wishlist/time';

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ResourceConnection $connection,
        DateTime $date
    ) {
        $this->connection = $connection->getConnection();
        $this->scopeConfig = $scopeConfig;
        $this->date = $date;
    }

    public function execute()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $time = $this->scopeConfig->getValue(self::XML_PATH_GUESTWISHLIST_TIME, $storeScope);

        $table = $this->connection->getTableName("wishlist");
        $this->connection->delete($table, ["customer_id = 0", "datediff(now(), updated_at) >= $time"]);
    }
}
