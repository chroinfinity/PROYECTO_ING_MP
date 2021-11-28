<?php 

    class DocxConversion{
        private $filename;

        public function __construct($filePath) {
            $this->filename = $filePath;
        }

        private function read_doc() {
            $fileHandle = fopen($this->filename, "r");
            $line = @fread($fileHandle, filesize($this->filename));   
            $lines = explode(chr(0x0D),$line);
            $outtext = "";
            foreach($lines as $thisline)
            {
                $pos = strpos($thisline, chr(0x00));
                if (($pos !== FALSE)||(strlen($thisline)==0))
                {
                } else {
                    $outtext .= $thisline." ";
                }
            }
            $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
            return $outtext;
        }

        private function read_docx(){

            $striped_content = '';
            $content = '';

            $Zip = new ZipArchive;
            $res = $Zip->open('test.zip');
            if ($res === TRUE) {
                    echo 'ok';
                    $Zip->extractTo('test');
                    $Zip->close();
                } else {
                    echo 'failed, code:' . $res;
            }


            $zipfileName = 'test.zip';
            //$zip = zip_open($this->filename);

            if (!$Zip || is_numeric($Zip)) return false;
            $opened = $Zip->open( $zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE );

            while ($Zip_entry = Zip_read($Zip)) {

                if (Zip_entry_open($Zip, $Zip_entry) == FALSE) continue;

                if (Zip_entry_name($Zip_entry) != "Word/document.xml") continue;

                $content .= Zip_entry_read($Zip_entry, Zip_entry_filesize($Zip_entry));

                Zip_entry_close($Zip_entry);
            }// end while

            Zip_close($Zip);

            $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
            $content = str_replace('</w:r></w:p>', "\r\n", $content);
            $striped_content = strip_tags($content);

            return $striped_content;
        }

    /************************Excel sheet************************************/

    function xlsx_to_text($input_file){
        $xml_filename = "xl/sharedStrings.xml"; //content file name
        $Zip_handle = new ZipArchive;
        $output_text = "";
        if(true === $Zip_handle->open($input_file)){
            if(($xml_index = $Zip_handle->locateName($xml_filename)) !== false){
                $xml_datas = $Zip_handle->getFromIndex($xml_index);
                $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text = strip_tags($xml_handle->saveXML());
            }else{
                $output_text .="";
            }
            $Zip_handle->close();
        }else{
        $output_text .="";
        }
        return $output_text;
    }

    /*************************power point files*****************************/
    function pptx_to_text($input_file){
        $Zip_handle = new ZipArchive;
        $output_text = "";
        if(true === $Zip_handle->open($input_file)){
            $slide_number = 1; //loop through slide files
            while(($xml_index = $Zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
                $xml_datas = $Zip_handle->getFromIndex($xml_index);
                $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text .= strip_tags($xml_handle->saveXML());
                $slide_number++;
            }
            if($slide_number == 1){
                $output_text .="";
            }
            $Zip_handle->close();
        }else{
        $output_text .="";
        }
        return $output_text;
    }


        public function convertToText() {

            if(isset($this->filename) && !file_exists($this->filename)) {
                return "File Not exists";
            }

            $fileArray = pathinfo($this->filename);
            $file_ext  = $fileArray['extension'];
            if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx")
            {
                if($file_ext == "doc") {
                    return $this->read_doc();
                } elseif($file_ext == "docx") {
                    return $this->read_docx();
                } elseif($file_ext == "xlsx") {
                    return $this->xlsx_to_text();
                }elseif($file_ext == "pptx") {
                    return $this->pptx_to_text();
                }
            } else {
                return "Invalid File Type";
            }
        }

    }
?>