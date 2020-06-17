<?php

class PaginationHandler {

    private $page;
    private $pageLimit;
    private $pageOffset;

    /**
     * Get the value of page
     */ 
    public function getPage() {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */ 
    public function setPage($page) {
        $this->page = $page;
        return $this;
    }
    
    /**
     * Get the value of limit
     */ 
    public function getPageLimit() {
        return $this->pageLimit;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */ 
    public function setPageLimit($pageLimit) {
        $this->pageLimit = $pageLimit;
        return $this;
    }
    
    /**
     * Get the value of offset
     */ 
    public function getPageOffset() {
        $page = $this->page;
        $limit = $this->pageLimit;

        if (is_numeric($limit) && $limit > 10) {
            $limit = $limit;
        } else {
            $limit = 10;
        }

        return (($limit * $page) - $limit);
    }

    /**
     * Set the value of offset
     *
     * @return  self
     */ 
    public function setPageOffset($pageOffset) {
        $this->pageOffset = $pageOffset;
        return $this;
    }

    public function getNumberOfPages($count) {
        return ceil($count / $this->pageLimit);
    }

}