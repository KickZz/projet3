<?php
//tests/SiteBundle/Prix/PrixTest.php

namespace Tests\P3\SiteBundle\Prix;
use PHPUnit\Framework\TestCase;
    
use P3\SiteBundle\Prix\Prix;

class PrixTest extends TestCase
{
   
    public function testDevraitRetournerZeroCarAgeTroisEtPasDeTarifReduit()
    {
        
        $prix = new Prix();
        $result = $prix->calculPrix(3, false);
        
        $this->assertEquals(0, $result);
        
        
    }
    public function testDevraitRetournerHuitCarAgeCinqEtPasDeTarifReduit()
    {

        $prix = new Prix();
        $result = $prix->calculPrix(5, false);
        
        $this->assertEquals(8, $result);
        
        
    }
    public function testDevraitRetournerSeizeCarAgeTreizeEtPasDeTarifReduit()
    {

        $prix = new Prix();
        $result = $prix->calculPrix(13, false);
        
        $this->assertEquals(16, $result);
        
        
    }
    public function testDevraitRetournerDouzeCarAgeSoixanteEtPasDeTarifReduit()
    {

        $prix = new Prix();
        $result = $prix->calculPrix(60, false);
        
        $this->assertEquals(12, $result);
        
        
    }
    public function testDevraitRetournerZeroCarAgeTroisTarifReduitVrai()
    {

        $prix = new Prix();
        $result = $prix->calculPrix(3, true);
        
        $this->assertEquals(0, $result);
        
        
    }
    public function testDevraitRetournerDixCarAgeTreizeEtTarifReduitVrai()
    {

        $prix = new Prix();
        $result = $prix->calculPrix(13, true);
        
        $this->assertEquals(10, $result);
        
        
    }
    public function testDevraitRetournerDixCarAgeSoixantesEtTarifReduitVrai()
    {

        $prix = new Prix();
        $result = $prix->calculPrix(60, true);
        
        $this->assertEquals(10, $result);
        
        
    }
    
}