<?php
namespace AppBundle\Doctrine;

use Doctrine\ORM\Query;

class Paginator
{
    private $pages;
    private $pages_count;
    private $total_items_count;
    private $items;

    /**
     * @param Query $query
     * @param int   $current_page
     * @param int   $items_on_page
     * @return $this
     */
    public static function paginate(Query $query, $current_page = 1, $items_on_page = 50)
    {
        $total_items = count($query->getResult());

        $items_on_page = $items_on_page > $total_items ? $total_items : $items_on_page;
        $items_on_page = self::ITEMS_ALL === $items_on_page ? $total_items : $items_on_page;
        $items_on_page = $items_on_page > 0 ? $items_on_page : self::ITEMS_MIN;

        $pages_count = ceil($total_items / $items_on_page);

        $items = $query
            ->setFirstResult($items_on_page * ($current_page - 1))// set the offset
            ->setMaxResults($items_on_page)// set the limit
            ->getResult();

        return (new self())
            ->setItems($items)
            ->setTotalItemsCount($total_items)
            ->setPagesCount($pages_count)
            ->setPages(self::paginationNumbers($current_page, $pages_count));
    }

    /**
     * @param     $page
     * @param     $total
     * @param int $range
     * @return array
     */
    private static function paginationNumbers($page, $total, $range = 5)
    {
        if ($range % 2 === 0) {
            $range++;
        }

        $half = ($range - 1) / 2;

        $right = $page + $half;

        if ($right > $total) {
            $left = $page - ($right - $total) - $half;
        } else {
            $left = $page - $half;
        }

        if ($left <= 0) {
            $right += abs($left);
            $right++;
            $left = 1;
        }

        $pages = [];

        for ($i = $left; $i <= $right && $i <= $total; $i++) {
            $pages[] = $i;
        }

        return $pages;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param $pages
     * @return $this
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagesCount()
    {
        return $this->pages_count;
    }

    /**
     * @param $pages_count
     * @return $this
     */
    public function setPagesCount($pages_count)
    {
        $this->pages_count = $pages_count;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalItemsCount()
    {
        return $this->total_items_count;
    }

    /**
     * @param $total_items_count
     * @return $this
     */
    public function setTotalItemsCount($total_items_count)
    {
        $this->total_items_count = $total_items_count;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }
}
