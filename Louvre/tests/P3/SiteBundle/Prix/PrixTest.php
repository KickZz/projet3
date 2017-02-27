<?php
//tests/SiteBundle/Prix/PrixTest.php

namespace Tests\P3\SiteBundle\Prix;
use PHPUnit\Framework\TestCase;
    
use P3\SiteBundle\Prix\Prix;

class PrixTest extends TestCase
{
    
    public function testAge3()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(3, false);
        
        $this->assertEquals(0, $result);
        
        
    }
    public function testAge5()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(5, false);
        
        $this->assertEquals(8, $result);
        
        
    }
    public function testAge13()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(13, false);
        
        $this->assertEquals(16, $result);
        
        
    }
    public function testAge60()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(60, false);
        
        $this->assertEquals(12, $result);
        
        
    }
    public function testAge3TarifReduit()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(3, true);
        
        $this->assertEquals(0, $result);
        
        
    }
    public function testAge60TarifReduit()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(60, true);
        
        $this->assertEquals(10, $result);
        
        
    }
    
}