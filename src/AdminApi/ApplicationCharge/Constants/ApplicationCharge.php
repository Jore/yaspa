<?php

namespace Yaspa\AdminApi\ApplicationCharge\Constants;

/**
 * Class ApplicationCharge
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Constants
 * @see https://help.shopify.com/api/reference/applicationcharge
 */
class ApplicationCharge
{
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';
    const STATUS_EXPIRED = 'expired';
    const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_ACCEPTED,
        self::STATUS_DECLINED,
        self::STATUS_EXPIRED
    ];
}
