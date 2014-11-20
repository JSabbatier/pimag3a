<?php
$mesDatas = '{"arrivage":{"dateArr":"2014-11-08","dateCont":"2014-03-17 07:01","numArr":648770,"nomFour":"Ortega","qualite":7,"numTrac":354306,"quantite":888067,"longueur":44,"tcaf":53,"tcai":21,"gout":"non","derog":"non","codebarre":44437924037},"seuil":{"long":{"min":1,"max":98},"diam1":{"min":23.5,"max":24.5},"diam2":{"min":23.5,"max":24.5},"ovali":0.7,"humi":{"min":4,"max":6},"diam_comp":90,"tcaf":95,"tcai":96},"bouchon":[{"id":1,"long":52.94,"diam1":23.61,"diam2":23.74,"ovali":0.79,"humi":3.98,"diam_comp":96.91},{"id":2,"long":37.75,"diam1":24.01,"diam2":23.93,"ovali":0.65,"humi":4.24,"diam_comp":98.95},{"id":3,"long":81.21,"diam1":23.4,"diam2":24.57,"ovali":0.38,"humi":4.72,"diam_comp":89.2},{"id":4,"long":17.01,"diam1":24.03,"diam2":24.08,"ovali":0.03,"humi":4.07,"diam_comp":92.65},{"id":5,"long":46.9,"diam1":23.82,"diam2":24.21,"ovali":0.54,"humi":6.13,"diam_comp":93.7},{"id":6,"long":37.05,"diam1":24.49,"diam2":24.26,"ovali":0.36,"humi":4.76,"diam_comp":92.18},{"id":7,"long":21.08,"diam1":23.58,"diam2":23.45,"ovali":0.01,"humi":4.25,"diam_comp":98.},{"id":8,"long":1.39,"diam1":24.22,"diam2":24.01,"ovali":0.94,"humi":6.15,"diam_comp":88.44},{"id":9,"long":53.88,"diam1":24.48,"diam2":23.68,"ovali":0.51,"humi":4.03,"diam_comp":95.77},{"id":10,"diam1":23.86,"diam2":24.49,"ovali":0.51,"humi":5.96,"diam_comp":89.4},{"id":11,"long":55.54,"diam2":23.92,"ovali":0.46,"humi":3.93,"diam_comp":88.61},{"id":12,"long":79,"diam1":24.18,"ovali":0.13,"humi":4.34,"diam_comp":90.36},{"id":13,"long":90.98,"diam1":23.81,"diam2":23.94,"humi":5.15,"diam_comp":98.56},{"id":14,"long":80.44,"diam1":23.69,"diam2":24.49,"ovali":0.37,"diam_comp":89.34},{"id":15,"long":30.08,"diam1":24.1,"diam2":23.95,"ovali":0.39,"humi":5.58},{"id":16,"long":34.4,"diam1":23.6,"diam2":24.01,"ovali":0.14,"humi":4.6,"diam_comp":98.28}]}';

require('fpdf17/fpdf.php');
//require('fpdf17/PDF_Code39.php');

class PDF extends FPDF
{
// Chargement des données
function LoadData($mydatas)
{
    // Lecture des lignes du fichier
    $data = json_decode($mydatas, true);
    return $data;
}

// Tableau coloré
function FancyTable($header, $data)
{
    // Couleurs, épaisseur du trait et police grasse
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');

    // En-tête
    $w = array(10, 30, 30, 30, 30, 30, 30);

    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],'LRT',0,'C',true);
    $this->Ln();

    $seuil = array('', $data['seuil']['long']['min'].' < L < '.$data['seuil']['long']['max'], utf8_decode($data['seuil']['diam1']['min'].' < Ø < '.$data['seuil']['diam1']['max']), utf8_decode($data['seuil']['diam2']['min'].' < Ø < '.$data['seuil']['diam2']['max']), ' O < '.$data['seuil']['ovali'], $data['seuil']['humi']['min'].' < H < '.$data['seuil']['humi']['max'], utf8_decode($data['seuil']['diam_comp'].' < Ø '));

    for($i=0;$i<count($seuil);$i++)
        $this->Cell($w[$i],6,$seuil[$i],'LRB',0,'C',true);
    $this->Ln();

    // Restauration des couleurs et de la police
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');

    $deflong=0;
    $defdiam1=0;
    $defdiam2=0;
    $defovali=0;
    $defhumi=0;
    $defdiam_comp=0;

    // Données
    $fill = false;
    foreach($data["bouchon"] as $row)
    {
        $idcolor = 0;
        if (!isset($row["long"])){$long=false;$longcolor = 0;}else                  if (($row["long"] > $data['seuil']['long']['min']) && ($row["long"] < $data['seuil']['long']['max'])){$longcolor = 0;$long=$row["long"];}else{$idcolor ++;$long=$row["long"];$longcolor = 200;$deflong++;}
        if (!isset($row["diam1"])){$diam1=false;$diam1color = 0;}else               if (($row["diam1"] > $data['seuil']['diam1']['min']) && ($row["diam1"] < $data['seuil']['diam1']['max'])){$d1color = 0;$diam1=$row["diam1"];}else{$diam1=$row["diam1"];$idcolor ++;$d1color = 200;$defdiam1++;}
        if (!isset($row["diam2"])){$diam2=false;$diam2color = 0;}else               if (($row["diam2"] > $data['seuil']['diam2']['min']) && ($row["diam2"] < $data['seuil']['diam2']['max'])){$d2color = 0;$diam2=$row["diam2"];}else{$diam2=$row["diam2"];$idcolor ++;$d2color = 200;$defdiam2++;}
        if (!isset($row["ovali"])){$ovali=false;$ovalicolor = 0;}else               if ($row["ovali"] < $data['seuil']['ovali']){$ovacolor = 0;$ovali=$row["ovali"];}else{$idcolor ++;$ovacolor = 200;$defovali++;$ovali=$row["ovali"];}
        if (!isset($row["humi"])){$humi=false;$humicolor = 0;}else                  if (($row["humi"] > $data['seuil']['humi']['min']) && ($row["humi"] < $data['seuil']['humi']['max'])){$humicolor = 0;$humi=$row["humi"];}else{$idcolor ++;$humicolor = 200;$defhumi++;$humi=$row["humi"];}
        if (!isset($row["diam_comp"])){$diam_comp=false;$diam_compcolor = 0;}else   if ($row["diam_comp"] > $data['seuil']['diam_comp']){$dccolor = 0;$diam_comp=$row["diam_comp"];}else{$diam_comp=$row["diam_comp"];$idcolor ++;$dccolor = 200;$defdiam_comp++;}
        if ($idcolor > 0){$idcolor=200;}

         // var_dump($row);
        $this->Cell($w[0],6,$row["id"],'LR',$this->SetTextColor($idcolor,0,0),'C',$fill);
        $this->Cell($w[1],6,$long,'LR',$this->SetTextColor($longcolor,0,0),'R',$fill);
        $this->Cell($w[2],6,$diam1,'LR',$this->SetTextColor($d1color,0,0),'R',$fill);
        $this->Cell($w[3],6,$diam2,'LR',$this->SetTextColor($d2color,0,0),'R',$fill);
        $this->Cell($w[4],6,$ovali,'LR',$this->SetTextColor($ovacolor,0,0),'R',$fill);
        $this->Cell($w[5],6,$humi,'LR',$this->SetTextColor($humicolor,0,0),'R',$fill);
        $this->Cell($w[6],6,$diam_comp,'LR',$this->SetTextColor($dccolor,0,0),'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    $this->SetTextColor(0,0,0);
    // Trait de terminaison
    $this->Cell(array_sum($w),0,'','T');
    $this->Ln(2);

    $defauts = array(utf8_decode('Déf.'), $deflong, $defdiam1, $defdiam2, $defovali, $defhumi, $defdiam_comp);

    if ($deflong > 1){$deflongcolor=200;}else{$deflongcolor=0;}
    if ($defdiam1 > 1){$defdiam1color=200;}else{$defdiam1color=0;}
    if ($defdiam2 > 1){$defdiam2color=200;}else{$defdiam2color=0;}
    if ($defovali > 2){$defovalicolor=200;}else{$defovalicolor=0;}
    if ($defhumi > 0){$defhumicolor=200;}else{$defhumicolor=0;}
    if ($defdiam_comp > 0){$defdiam_compcolor=200;}else{$defdiam_compcolor=0;}

    $this->Cell($w[0],6,$defauts[0],'LRBT',0,'C',false);
    $this->Cell($w[1],6,$defauts[1],'LRBT',$this->SetTextColor($deflongcolor,0,0),'C',false);
    $this->Cell($w[2],6,$defauts[2],'LRBT',$this->SetTextColor($defdiam1color,0,0),'C',false);
    $this->Cell($w[3],6,$defauts[3],'LRBT',$this->SetTextColor($defdiam2color,0,0),'C',false);
    $this->Cell($w[4],6,$defauts[4],'LRBT',$this->SetTextColor($defovalicolor,0,0),'C',false);
    $this->Cell($w[5],6,$defauts[5],'LRBT',$this->SetTextColor($defhumicolor,0,0),'C',false);
    $this->Cell($w[6],6,$defauts[6],'LRBT',$this->SetTextColor($defdiam_compcolor,0,0),'C',false);
    $this->Ln(8);

    if($data["arrivage"]["tcaf"]<2){$color=0;}else{$color=200;};
    $this->Cell(array_sum($w)/6+10,6,"TCA Fournisseur: ",'LBT',$this->SetTextColor(0,0,0),'R',false);
    $this->Cell(array_sum($w)/6-10,6,$data["arrivage"]["tcaf"],'RBT',$this->SetTextColor($color,0,0),'L',false);

    if($data["arrivage"]["tcai"]<2){$color=0;}else{$color=200;};
    $this->Cell(array_sum($w)/6+10,6,"TCA Interne: ",'LBT',$this->SetTextColor(0,0,0),'R',false);
    $this->Cell(array_sum($w)/6-10,6,$data["arrivage"]["tcai"],'RBT',$this->SetTextColor($color,0,0),'L',false);

    if($data["arrivage"]["gout"]=="oui"){$color=0;}else{$color=200;};
    $this->Cell(array_sum($w)/6+10,6,utf8_decode("Goût: "),'LBT',$this->SetTextColor(0,0,0),'R',false);
    $this->Cell(array_sum($w)/6-10,6,$data["arrivage"]["gout"],'RBT',$this->SetTextColor($color,0,0),'L',false);

    $this->SetTextColor(0,0,0);
}

// En-tête
function Header()
{
    // Logo
    $this->Image('img/profile.png',10,6,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(50);
    // Titre
    $this->Cell(90,10,utf8_decode('Fiche de contrôle qualité arrivage'),1,0,'C');
    // Saut de ligne
    $this->Ln(10);
}

// Pied de page
function Pied($data)
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-70);
    $this->SetX(-200);

$w = array(10, 30, 30, 30, 30, 30, 30);
    // Police Arial italique 8
    $this->SetFont('Arial','',11);
    // Numéro de page
    $this->Cell(190/2,7,utf8_decode('Date du contrôle: '.$data["arrivage"]["dateCont"]),0,0,'L');
    $this->Ln();
    $this->Cell(37,7,utf8_decode('Responsable qualité:'),0,0,'L');
    $this->Cell(58,7,"",'B',0,'L');
    $this->Cell(190/2,7,utf8_decode('Signature'),0,0,'C');
}
function AjouterChapitre($titre, $data)
{
    $this->TitreChapitre($titre);
    $this->CorpsChapitre($data);
}
function TitreChapitre($libelle)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Couleur de fond
    $this->SetFillColor(255,255,255);
    // Titre
    $this->Cell(0,6,"$libelle",0,1,'L',true);
    // Saut de ligne
    $this->Ln(4);
}

function ImprovedTable( $data)
{
    $conf=$this->Conformite($data);
    if ($conf=="CONFORME"){
        $rouge="25";$vert="225";
    }else{
       $rouge="225";$vert="25";
    }
    
    $this->SetFillColor($rouge,$vert,25); 
    $this->SetDrawColor(0,0,0);
    $this->SetFont('Arial','',11);

    // Largeurs des colonnes
    $w = array(30, 30);

    // Données
    $this->Cell($w[0],7,"Date arrivage:",'LT');
    $this->Cell($w[1],7,$data["arrivage"]["dateArr"],'RT',0,'R');
    $this->Ln();
    $this->Cell($w[0],7,utf8_decode("Numéro arrivage:"),'L');
    $this->Cell($w[1],7,$data["arrivage"]["numArr"],'R',0,'R');
    $this->Ln();
    $this->Cell($w[0],7,"Nom fournisseur:",'L');
    $this->Cell($w[1],7,$data["arrivage"]["nomFour"],'R',0,'R');
    $this->Ln();
    $this->Cell($w[0],7,"Longueur:",'L');
    $this->Cell($w[1],7,$data["arrivage"]["longueur"],'R',0,'R');
    $this->Ln();
    $this->Cell($w[0],7,utf8_decode("Qualité:"),'L');
    $this->Cell($w[1],7,$data["arrivage"]["qualite"],'R',0,'R');    
    
    $this->Cell(30);
    $this->SetDrawColor($rouge,$vert,25);
    $this->Cell(70,7,"",'TBLR',0,'R', true);
    $this->SetDrawColor(0,0,0);

    $this->Ln();
    $this->Cell($w[0],7,utf8_decode("Numéro Traçabilité:"),'L');
    $this->Cell($w[1],7,$data["arrivage"]["numTrac"],'R',0,'R');

    $this->Cell(30);
    $this->SetFont('Arial','B',15);
    $this->SetDrawColor($rouge,$vert,25);
    $this->Cell(70,7,utf8_decode($conf),'TBLR',0,'C', true);

    $this->SetFont('Arial','',11);
    $this->SetDrawColor(0,0,0);
    $this->Ln();
    $this->Cell($w[0],7,utf8_decode("Quantité:"),'LB');
    $this->Cell($w[1],7,$data["arrivage"]["quantite"],'RB',0,'R');

    $this->Cell(30);
    $this->SetDrawColor($rouge,$vert,25);
    $this->Cell(70,7,"",'TBLR',0,'R', true);
    $this->SetDrawColor(0,0,0);

    $this->Ln(15);  

}

function Conformite($data)
{
    $deflong=0;
    $defdiam1=0;
    $defdiam2=0;
    $defovali=0;
    $defhumi=0;
    $defdiam_comp=0;

    foreach($data["bouchon"] as $row)
    {
        if (isset($row["long"])){ if (($row["long"] < $data['seuil']['long']['min']) || ($row["long"] > $data['seuil']['long']['max'])){$deflong++;}};
        if (isset($row["diam1"])){if (($row["diam1"] < $data['seuil']['diam1']['min']) || ($row["diam1"] > $data['seuil']['diam1']['max'])){$defdiam1++;}};
        if (isset($row["diam2"])){if (($row["diam2"] < $data['seuil']['diam2']['min']) || ($row["diam2"] > $data['seuil']['diam2']['max'])){$defdiam2++;}};
        if (isset($row["ovali"])){if ($row["ovali"] > $data['seuil']['ovali']){$defovali++;}};
        if (isset($row["humi"])){if (($row["humi"] < $data['seuil']['humi']['min']) || ($row["humi"] > $data['seuil']['humi']['max'])){$defhumi++;}};
        if (isset($row["diam_comp"])){if ($row["diam_comp"] < $data['seuil']['diam_comp']){$defdiam_comp++;}};
    }

    if ($deflong > 1){$conforme="NON CONFORME";}else{$conforme="CONFORME";}
    if ($defdiam1 > 1){$conforme="NON CONFORME";}else{$conforme="CONFORME";}
    if ($defdiam2 > 1){$conforme="NON CONFORME";}else{$conforme="CONFORME";}
    if ($defovali > 2){$conforme="NON CONFORME";}else{$conforme="CONFORME";}
    if ($defhumi > 0){$conforme="NON CONFORME";}else{$conforme="CONFORME";}
    if ($defdiam_comp > 0){$conforme="NON CONFORME";}else{$conforme="CONFORME";}
   // if ($ > 0){$conforme="NON CONFORME";}else{$conforme="CONFORME";} -----------------------------------------------------------------------------------------------

    return $conforme;
}

function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5){

    $wide = $baseline;
    $narrow = $baseline / 3 ; 
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn'; 
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial','',10);
    $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code[$i];
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq[$bar] == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
}
}

$pdf = new PDF("P");
// Titres des colonnes
$header = array(utf8_decode('N°'), 'Longueur', utf8_decode('Diamètre 1'), utf8_decode('Diamètre 2'),'Ovalisation', utf8_decode('Humidité (%)'), utf8_decode('Diamètre A.C.'));
// Chargement des données
$data = $pdf->LoadData($mesDatas);
$pdf->SetFont('Arial','',11);
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);

$pdf->AddPage();
$pdf->Ln(20);
$pdf->ImprovedTable($data);
$pdf->Code39(100,40,$data["arrivage"]["codebarre"],1,20);
$pdf->Conformite($data);
$pdf->FancyTable($header,$data);
$pdf->Pied($data);
$pdf->Output("ControleArrivee_".$data["arrivage"]["nomFour"]."_".$data["arrivage"]["dateArr"]."_".$data["arrivage"]["numArr"].".pdf","I");

?>