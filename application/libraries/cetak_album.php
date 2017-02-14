<?php
require('fpdf.php');

// Written by Larry Stanbery - 20 May 2004
// "freeware" -- same license as FPDF
// creates "page groups" -- groups of pages with page numbering
// total page numbers are represented by aliases of the form {nbX}

class Cetak_album extends FPDF
{
    var $NewPageGroup;   // variable indicating whether a new group was requested
    var $PageGroups;     // variable containing the number of pages of the groups
    var $CurrPageGroup;  // variable containing the alias of the current page group

    // create a new page group; call this before calling AddPage()
    function StartPageGroup()
    {
        $this->NewPageGroup=true;
    }

    function Header()
{
    // To be implemented in your own inherited class
    if($this->PageNo() != '1')
    {
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial','',11);
        $this->Cell(42);
        $this->Image(base_url('connect_postgresql/asset/uin.jpg'),28,22,20,25,'jpg');
        $this->Cell(40,5,'ALBUM BUKTI HADIR PESERTA UJIAN TULIS 2016',0,0,'L');
        $this->Ln();
        $this->Ln();
        $this->Cell(42);
        $this->Cell(20,5,'SEKTOR',0,0,'L');
        $this->Cell(3,5,':',0,0,'C');
        $this->Cell(40,5,'UIN SUNAN KALIJAGA YOGYAKARTA',0,0,'L');
        $this->Ln();
        $this->Cell(42);
        $this->Cell(20,5,'LOKASI',0,0,'L');
        $this->Cell(3,5,':',0,0,'C');
        $this->Cell(40,5,'PROGRAM PASCASARJANA',0,0,'L');
        $this->Ln();
        $this->Cell(42);
        $this->Cell(20,5,'RUANG',0,0,'L');
        $this->Cell(3,5,':',0,0,'C');
        $this->Cell(40,5,'201',0,0,'L');
    
    }
}

    // current page in the group
    function GroupPageNo()
    {
        return $this->PageGroups[$this->CurrPageGroup];
    }

    // alias of the current page group -- will be replaced by the total number of pages in this group
    function PageGroupAlias()
    {
        return $this->CurrPageGroup;
    }

    function _beginpage($orientation)
    {
        parent::_beginpage($orientation);
        if($this->NewPageGroup)
        {
            // start a new group
            $n = sizeof($this->PageGroups)+1;
            $alias = "{nb$n}";
            $this->PageGroups[$alias] = 1;
            $this->CurrPageGroup = $alias;
            $this->NewPageGroup=false;
        }
        elseif($this->CurrPageGroup)
            $this->PageGroups[$this->CurrPageGroup]++;
    }

    function Footer()
    {
    $this->SetY(-20);
    $this->Cell(0, 6, 'Halaman '.$this->GroupPageNo().'/'.$this->PageGroupAlias(), 0, 0, 'C');
    }

    function _putpages()
    {
        $nb = $this->page;
        if (!empty($this->PageGroups))
        {
            // do page number replacement
            foreach ($this->PageGroups as $k => $v)
            {
                for ($n = 1; $n <= $nb; $n++)
                {
                    $this->pages[$n]=str_replace($k, $v, $this->pages[$n]);
                }
            }
        }
        parent::_putpages();
    }
}
?>