<?php
Class NumToInr{
    public $ones = array('','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen');
    public $twos = array('','Ten','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety');
    public function Inr($string){
        $digit = $string;
        $digit = str_replace(",","",$digit);
        $digit = ltrim($digit,0);
        $digit = explode(".",$digit);
        //Digit array Count
        $digit_count = count($digit);
        if($digit_count >= 2 ){
            $number = $digit[0];
            $decimal = $digit[1];
        }elseif($digit_count =1){
            $number = $digit[0];
            $decimal = 00;
        }
        if($number <= 99 ){
            return $this->Tens($number)." Rupees ".$this->decimal($decimal);
        }elseif($number <= 999){
            return $this->Hundreds($number)." Rupees ".$this->decimal($decimal);
        }elseif($number <= 9999){
            return $this->Thousands($number)." Rupees ".$this->decimal($decimal);
        }
        elseif($number <= 99999){
            return $this->Thousands($number)." Rupees ".$this->decimal($decimal);
        }elseif($number <= 9999999){
            return $this->Lakhs($number)." Rupees ".$this->decimal($decimal);
        }elseif($number <= 999999999){
            return $this->Crores($number)." Rupees ".$this->decimal($decimal);
        }
    }
    
    public function decimal($decimal){
        $decimal_len = strlen($decimal);
        if(empty($decimal) || $decimal == 00){
            return false;
        }elseif($decimal_len == 1 && $decimal <= 9){
            return " and ".$this->twos[$decimal]." paisa";
        }else{
            return " and ".$this->Tens($decimal)." paisa";    
        }
        
    }
    public function Tens($number){
        $number     = ltrim($number,0);
        $number_len = strlen($number);
        //Number 1 - 19
        if($number == 00){
            return false;
        }
        elseif($number <= 19 && $number_len <= 2 ){
            return $this->ones[$number];
        }
        //Number 20 - 99
        elseif($number <= 99 && $number_len == 2){
            //Greater than 19 to 99
            $one = substr($number,0,1);//2
            $two = substr($number,1,1);//0
            return $this->twos[$one]." ".$this->ones[$two];
        }
    }
    public function Hundreds($number){
        $number     = ltrim($number,0);
        $number_len = strlen($number);
        if($number == 000){
            return false;    
        }elseif($number_len == 2){
            return $this->Tens($number);
        }else{
            return $this->Tens(substr($number,0,1))." Hundred ".$this->Tens(substr($number,1,2));
        }
    }
    public function Thousands($number){
        $number     = ltrim($number,0);
        $number_len = strlen($number);
        if($number == 0){
            return false;
        }
        elseif($number_len == 4){
            return $this->Tens(substr($number,0,1))." Thousand ".$this->Hundreds(substr($number,1,3));
        }else{
            return $this->Tens(substr($number,0,2))." Thousand ".$this->Hundreds(substr($number,2,4));    
        }
        
    }
    public function Lakhs($number){
        $number     = ltrim($number,0);
        $number_len = strlen($number);
        if($number == 0){
            return false;
        }
        elseif($number_len == 6){
            return $this->Tens(substr($number,0,1))." Lakh ". $this->Thousands(substr($number,1,5));
        }
        else{
            return $this->Tens(substr($number,0,2))." Lakh ". $this->Thousands(substr($number,2,6));
        }
    }
    public function Crores($number){
        $number     = ltrim($number,0);
        $number_len = strlen($number);
        if($number_len == 8){
            return $this->Tens(substr($number,0,1))." Crore ". $this->Lakhs(substr($number,1,7));
//            return substr($number,1,7);
        }else{
            return $this->Tens(substr($number,0,2))." Crore ". $this->Lakhs(substr($number,2,7));
//            return substr($number,2,7);
        }
    }
}

$inr = new NumToInr();

?>