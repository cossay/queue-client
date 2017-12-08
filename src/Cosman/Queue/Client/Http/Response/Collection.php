<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Response;

use Cosman\Queue\Client\Model\BaseModel;

/**
 *
 * @author cosman
 *        
 */
class Collection implements \IteratorAggregate
{

    /**
     *
     * @var BaseModel
     */
    protected $items = [];

    /**
     *
     * @var int
     */
    protected $itemCounts = 0;

    /**
     *
     * @var bool
     */
    protected $hasMore = false;

    /**
     *
     * @param array $items
     * @param int $itemCounts
     * @param bool $hasMore
     */
    public function __construct(array $items = [], int $itemCounts = 0, bool $hasMore = false)
    {
        $this->itemCounts = $itemCounts;
        
        $this->hasMore = $hasMore;
        
        $this->items = $items;
    }

    /**
     * Returns items in collection
     *
     * @return \Cosman\Queue\Client\Model\BaseModel[]
     */
    public function getItems(): iterable
    {
        return $this->items;
    }

    /**
     * Sets items in collection
     *
     * @param BaseModel ...$items
     * @return self
     */
    public function setItems(BaseModel ...$items): self
    {
        $this->items = $items;
        
        return $this;
    }

    /**
     * Returns number of items in collection on server
     *
     * @return int
     */
    public function getCounts(): int
    {
        return $this->itemCounts;
    }

    /**
     * Sets number of items in collection on server
     *
     * @return self
     */
    public function setCounts(int $counts): self
    {
        $this->itemCounts = $counts;
        
        return $this;
    }

    /**
     * Indicates whether there is more of the items on the server
     *
     * @return bool
     */
    public function hasMore(): bool
    {
        return $this->hasMore;
    }

    /**
     * Sets whether there is more of the items on the server
     *
     * @param bool $hasMore
     * @return self
     */
    public function setHasMore(bool $hasMore): self
    {
        $this->hasMore = $hasMore;
        
        return $this;
    }

    /**
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}