<?php
// src/P3/SiteBundle/Prix/Prix.php

namespace P3\SiteBundle\Prix;

class Prix 
{
    /**
     * @param int $age
     * @param bool $tarifreduit
     * @return int
     */
    public function calculPrix($age, $tarifreduit){
        
        if ($age < 4){
                    $cout = 0;
            }
        else if ($tarifreduit != true)
            {
    
                if ($age >= 4 && $age < 12){
                    $cout = 8;
                }
                else if ($age >= 12 && $age < 60){
                    $cout = 16;
                }
                else if ($age >= 60){
                    $cout = 12;
                }
                
            }
        else if ($tarifreduit == true){
            if ($age >= 4 && $age < 12){
                    $cout = 8;
                }
            else{
                $cout = 10;
            }
            }
        return $cout;
    }
    
}