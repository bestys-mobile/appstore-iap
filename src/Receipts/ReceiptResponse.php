<?php


namespace Bestys\AppStore\Receipts;

use Bestys\AppStore\ValueObjects\PendingRenewal;
use Bestys\AppStore\ValueObjects\Receipt;
use Bestys\AppStore\ValueObjects\ReceiptInfo;
use Bestys\AppStore\ValueObjects\Status;

/**
 * Class ReceiptResponse
 * @package Imdhemy\AppStore\Receipts
 */
class ReceiptResponse
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var bool|null
     */
    protected $isRetryable;

    /**
     * @var string
     */
    protected $latestReceipt;

    /**
     * @var array|ReceiptInfo[]
     */
    protected $latestReceiptInfo;

    /**
     * @var array|PendingRenewal[]
     */
    protected $pendingRenewalInfo;

    /**
     * @var Receipt|null
     */
    protected $receipt;

    /**
     * @var Status
     */
    protected $status;

    /**
     * ReceiptResponse constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->environment = $attributes['environment'];
        $this->latestReceipt = $attributes['latest_receipt'];

        $this->latestReceiptInfo = [];
        foreach ($attributes['latest_receipt_info'] as $itemAttributes) {
            $this->latestReceiptInfo[] = ReceiptInfo::fromArray($itemAttributes);
        }

        $this->receipt = isset($attributes['receipt']) ? Receipt::fromArray($attributes['receipt']) : null;
        $this->status = new Status($attributes['status']);

        $attributes['pending_renewal_info'] = $attributes['pending_renewal_info'] ?? [];
        $this->pendingRenewalInfo = [];
        foreach ($attributes['pending_renewal_info'] as $item) {
            $this->pendingRenewalInfo[] = PendingRenewal::fromArray($item);
        }

        $this->isRetryable = $attributes['is-retryable'] ?? null;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @return bool|null
     */
    public function getIsRetryable(): ?bool
    {
        return $this->isRetryable;
    }

    /**
     * @return string
     */
    public function getLatestReceipt(): string
    {
        return $this->latestReceipt;
    }

    /**
     * @return array|ReceiptInfo[]
     */
    public function getLatestReceiptInfo(): array
    {
        return $this->latestReceiptInfo;
    }

    /**
     * @return array|PendingRenewal[]
     */
    public function getPendingRenewalInfo(): array
    {
        return $this->pendingRenewalInfo;
    }

    /**
     * @return Receipt|null
     */
    public function getReceipt(): ?Receipt
    {
        return $this->receipt;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }
}
