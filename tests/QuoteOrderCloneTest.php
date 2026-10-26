<?php

declare(strict_types=1);

namespace Tests;

use MailCampaigns\ApiClient\Entity\Order;
use MailCampaigns\ApiClient\Entity\Quote;
use PHPUnit\Framework\TestCase;

final class QuoteOrderCloneTest extends TestCase
{
    public function testQuoteWithLinkedOrderCanBeClonedIndependently(): void
    {
        $order = (new Order())->setOrderId(2)->setNumber('original');
        $quote = (new Quote())->setQuoteId(1)->addOrder($order);

        $copy = clone $quote;
        $copiedOrder = $copy->getOrders()->get(0);

        self::assertNotSame($quote, $copy);
        self::assertCount(1, $copy->getOrders());
        self::assertNotSame($quote->getOrders(), $copy->getOrders());
        self::assertNotSame($order, $copiedOrder);
        self::assertSame($copy, $copiedOrder->getQuote());
        self::assertSame($quote, $order->getQuote());
        self::assertNotSame($order->getCreatedAt(), $copiedOrder->getCreatedAt());
        $copiedOrder->setNumber('changed');
        self::assertSame('original', $order->getNumber());
    }

    public function testOrderCloneRetainsItsParentWithoutCloningTheGraph(): void
    {
        $order = (new Order())->setOrderId(2);
        $quote = (new Quote())->setQuoteId(1)->addOrder($order);

        $copy = clone $order;

        self::assertNotSame($order, $copy);
        self::assertSame($quote, $copy->getQuote());
        self::assertCount(1, $quote->getOrders());
        self::assertSame($order, $quote->getOrders()->get(0));
        self::assertNotSame($order->getOrderProducts(), $copy->getOrderProducts());
    }
}
