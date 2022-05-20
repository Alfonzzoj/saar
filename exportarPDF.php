

        $table        =$request->get('table');
        $tableFirmas  =$request->get('tableFirmas');
        $departamento =$request->get('departamento');
        $gerencia     =$request->get('gerencia');


       $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set default header data

        $pdf->SetHeaderData(asset('imgs/gobernacion.png'), '33', "SERVICIO AUTÓNOMO DE AEROPUERTOS REGIONALES DEL EDO. BOLÍVAR","SAAR BOLÍVAR\n".$gerencia."\n".$departamento);


        $pdf->setHeaderFont(Array(PDF_FONT_NAME_DATA, '', '8'));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


       // set default monospaced font

       $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

       // set margins

       $pdf->SetMargins('0.5', '18', '0.5');

       $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


       // set some language-dependent strings (optional)

       if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

           require_once(dirname(__FILE__).'/lang/eng.php');

           $pdf->setLanguageArray($l);

       }

       // --------------------------------------------------------       // set default font subsetting mode

       $pdf->setFontSubsetting(false);

       // Set font

       // dejavusans is a UTF-8 Unicode font, if you only need to

       // print standard ASCII chars, you can use core fonts like

       // helvetica or times to reduce file size.

       //$pdf->SetFont('helvetica', '', 8, '', true);


       // Start First Page Group
       $pdf->startPageGroup();

       // Add a page

       // This method has several options, check the source code documentation for more information.

       $pdf->AddPage();

       // set text shadow effect

       // Set some content to print

       //

       $html = view('pdf.generic', compact('table', 'tableFirmas'))->render();

       // Print text using writeHTMLCell()

       $pdf->writeHTML($html);

       // --------------------------------------------------------       // Close and output PDF document

       // This method has several options, check the source code documentation for more information.

       $pdf->Output("reporte.pdf", 'I');
