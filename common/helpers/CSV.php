<?php

namespace common\helpers;

use SplFileObject;
use Exception;
use common\models\quote\Quote;


class CSV
{
    private $_csv_file = null;
    private $_counter = 0;
    private $_number_of_lines = 0;
    private $_delimiter;

    /**
     * @return int
     */
    public function getCounter()
    {
        return $this->_counter;
    }

    /**
     * Getter for $_number_of_lines
     * @return int
     */
    public function getNumberOfLines()
    {
        return $this->_number_of_lines;
    }


    /**
     * @param string $csv_file path to file
     */
    public function __construct($csv_file, $delimiter = ',') {
        if(file_exists($csv_file)){
            $this->_delimiter = $delimiter;
            $this->_csv_file = $csv_file;
            // counting number of lines in CSV
            $obj = new SplFileObject($this->_csv_file);
            $obj->seek(PHP_INT_MAX);
            $this->_number_of_lines = $obj->key();
            $obj = null;
        }
        else{
            throw new Exception("File $csv_file is not found");
        }
    }

    /**
     * Writing to file
     * @param array $csv
     */
    public function setCSV(Array $csv) {
        $handle = fopen($this->_csv_file, "a");
        foreach($csv as $value){
            fputcsv($handle, explode(";", $value), ";");
        }
        fclose($handle);
    }

    /**
     * Reading whole file in an array of lines
     * @return array;
     */
    public function getCSV() {
        $handle = fopen($this->_csv_file, "r");
        $array_line_full = array();

        while (($line = fgetcsv($handle, 0, ",")) !== FALSE) {
            $array_line_full[] = $line;
        }
        fclose($handle);
        return $array_line_full;
    }

    /**
     * Reading line from file
     * @return array;
     */

    public function getLine(){
        $obj = new SplFileObject($this->_csv_file);
        $obj->seek($this->_counter);
        if($this->_counter < $this->_number_of_lines){
            $this->_counter++;
            $arr = $obj->fgetcsv($this->_delimiter);
        }else{
            $arr = null;
        }
        $obj = null;
        return $arr;
    }

    /**
     * Return the array of lines with applied filter
     * @param $filter
     */
    public function getFilteredCSV($filter){
        $handle = fopen($this->_csv_file, "r");
        $array_line_full = array();

        while (($line = fgetcsv($handle, 0, ",")) !== FALSE) {
            $key = strtoupper(trim($line[0]));
            if(array_key_exists($key,$filter)){
                $new_line = array();
                $new_line[] = $filter[$key];
                $new_line[] =  (float) trim($line[2]);
                $new_line[] = (float) trim($line[5]);
                $new_line[] = trim($line[1]);
                $new_line[] = (float) trim($line[4]);
                $new_line[] = (float) trim($line[3]);
                // making latdeal = closerate
                $new_line[] = (float) trim($line[5]);
                $new_line[] = null;
                $new_line[] = null;
                $new_line[] = null;
                $new_line[] = (int) trim($line[6]);
                $new_line[] = 1;
                $array_line_full[] = $new_line;
            }
        }
        fclose($handle);
        return $array_line_full;
    }
}