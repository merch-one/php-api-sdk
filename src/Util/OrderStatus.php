<?php

namespace MerchOne\PhpSdk\Util;

final class OrderStatus
{
    /**
     * Order has been submitted but not yet confirmed.
     */
    public const DRAFT = 'DRAFT';

    /**
     * Order has been confirmed and is being prepared for shipment.
     */
    public const ACCEPTED = 'ACCEPTED';

    /**
     * Order has been completed and the product(s) is ready to be shipped.
     */
    public const FULFILLED = 'FULFILLED';

    /**
     * Order has been cancelled by customer or admin.
     */
    public const CANCELLED = 'CANCELLED';

    /**
     * Order has been refunded to the customer.
     */
    public const REFUNDED = 'REFUNDED';

    /**
     * Order has been partially refunded to the customer.
     */
    public const PARTIAL_REFUND = 'PARTIAL_REFUND';

    /**
     * Order has been placed by the customer and is waiting for payment to be completed.
     */
    public const PENDING = 'PENDING';

    /**
     * Something went wrong during the processing of the order.
     */
    public const ERROR = 'ERROR';

    /**
     * Order was prepared to be sent to production.
     */
    public const GENERATED = 'GENERATED';

    /**
     * Order was sent to production.
     */
    public const IN_PROGRESS = 'IN_PROGRESS';
}
