<?php

namespace Wfm;

class Pagination
{
    protected $currentPage;
    protected $perpage;
    protected $total;
    protected $countPages;
    protected $uri;

    public function __construct($page, $perpage, $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if(!$page || $page < 1){
            $page = 1;
        }
        if($page > $this->countPages){
            $page = $this->countPages;
        }
        return $page;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if(isset($url[1]) && $url[1] != ''){
            $uri .= "?";
            $params = explode('&', $url[1]);
            foreach($params as $param){
                if(!preg_match("#page=#", $param)){
                    $uri .= $param."&";
                }
            }
        }
        return $uri;

    }
    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getHtml()
    {
        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page2left = null;
        $page1left = null;
        $page2right = null;
        $page1right = null;

        //Back
        if($this->currentPage > 1){
            $back = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->currentPage - 1)."'>Back</a></li>";
        }

        //Forward
        if($this->currentPage < $this->countPages){
            $forward = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->currentPage + 1)."'>Forward</a></li>";
        }
        //Startpage
        if($this->currentPage > 3){
            $startpage = "<li class='page-item'><a class='page-link' href='".$this->getLink(1)."'>Startpage</a></li>";
        }
        //Endpage
        if($this->currentPage < $this->countPages - 2){
            $endpage = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->countPages)."'>Endpage</a></li>";
        }
        //Page2Left
        if($this->currentPage - 2 > 0){
            $page2left = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->currentPage - 2)."'>".($this->currentPage - 2)."</a></li>";
        }
        //Page1Left
        if($this->currentPage - 1 > 0){
            $page1left = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->currentPage - 1)."'>".($this->currentPage - 1)."</a></li>";
        }
        //Page2right
        if($this->currentPage + 2 < $this->countPages){
            $page2right = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->currentPage + 2)."'>".($this->currentPage + 2)."</a></li>";
        }
        //Page1right
        if($this->currentPage + 1 < $this->countPages){
            $page1right = "<li class='page-item'><a class='page-link' href='".$this->getLink($this->currentPage + 1)."'>".($this->currentPage + 1)."</a></li>";
        }
        return "<nav><ul class='pagination'>".$startpage.$back.$page2left.$page1left."<li class='page-item active'><a class='page-link' href=''>".$this->currentPage."</a></li>".$page1right.$page2right.$forward.$endpage."</ul></nav>";

    }

    public function getLink($page)
    {
        if($page == 1){
            return rtrim($this->uri, '?&');
        }
        if(str_contains($this->uri, '&')){
            return $this->uri."page=".$page;
        }else{
            if(str_contains($this->uri, '?')){
                return $this->uri."page=".$page;
            }else{
                return $this->uri."?page=".$page;
            }
        }
    }

    public function __toString()
    {
        return $this->getHtml();
    }
}