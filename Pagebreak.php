<?php
error_reporting( error_reporting() & ~E_NOTICE );
defined('BASEPATH') OR exit('No direct script access allowed');


class Pagebreak { 

    private $page; //page number 
    private $numPages; //number of total pages 
    private $textarray = array(); // array of conents 
    private $pageCont; //current page content 

    public function __construct(){  
        if (!isset($_GET['page'])) { 
       
        } else {
        $this->page = $_GET['page'];  
        }  
		
    } 

    public function splitText($pageCont){  
        $this->textarray = preg_split('/(?<!\<div\>)\[next\]/', $pageCont);
        $this->numPages = count($this->textarray); 
    } 

    public function setPage(){ 
        $this->pageCont = $this->textarray[$_GET['page'] -1]; 
    } 

    public function getContent(){ 
        if($this->page != 0){ 
        echo $this->pageCont;  
        } else { 
        echo $this->textarray[0]; 
        } 
    } 

    public function getPageLinks(){ 

	
        echo "<section class=\"bottom-border\">
				</section>\n";     
        echo "<div class=\"pager-area clearfix\">\n";     
        echo "<ul class=\"pager pull-right\">\n";     

        //prev page 
        //if page number is more then 1 show previous link 
        if ($this->page > 1) { 
            $prevpage = $this->page - 1; 
            //echo "<li><a href=\"?page=$prevpage\">". 'Prev</a></li>'; 
        }  

        //page numbers   
        for($i = 1; $i <= $this->numPages ; $i++){ 
            if($this->numPages > 1){ // if more then 1 page show links 
                if(($this->page) == $i){ //if page number is equal page number in loop don't link it 
                    echo "<li class=\"aktif\"><a class=\"aktif\" href=?page=$i>$i</a></li>\n "; 
                    } else {                     
                            if($this->page == 0){ //if no page numbers have been clicked don't link first page link 
                                if($i == 1){ 
                                   echo "<li class=\"aktif\"><a class=\"aktif\" href=?page=$i>$i</a></li>\n "; 
                                } else { // link the rest 
								 echo "<li><a href=?page=$i>$i</a></li>";
                                  
                                }  
                           } else { // link pages 
						  
                                echo "<li><a href=\"?page=$i\">$i</a></li>\n "; 
                            }                          
                    } 
            }              
        } 

        //next page 
        //if page number is less then the total number of pages show next link 
        if ($this->page <= $this->numPages - 1) { 
            if($this->page == 0){ //if no page numbers have been clicked minus 2 from the next page link 
                $nextpage = $this->page + 2; 
            } else { 
                $nextpage = $this->page + 1; 
                } 
               // echo "<li><a  href=\"?page=$nextpage\">". 'Next</a></li>'; 
        } 
 echo "</ul>\n";
        echo "</div>\n";     

    } 
}
