<?php
/*=======================================
this is the php file for generating the
xkcd password
=========================================*/

/*=======================================
Define the variables here
=========================================*/

$nwords='';     #number of words required by the user
$numbornot='';  #include number in the password or not
$symbornot='';  #include symbol in the password or not
$finpasswd='';  #final password
$test_mess='';  #message display to guide/provide error info to user


/*=========================================
Define the wordlist, numberlist and symbollist here
wordlist: 25 words, numberlist:10 numbers, symbollist:5 symbols
============================================*/

$wordlist=array('able','bomb','cucumber','dumb','euler','fumble','abaci',
                'abate','genes','zebra','yawn','frown','clown','apple',
                'loser','heart','hatred','scissors','jacket','person',
                'build','knight','webster','university',);
$number=array('1','2','3','4','5','6','7','8','9','0');
$symb = array('#','@','&','%','!');



/*==================================================
Get user input from the _GET array here
===================================================*/
#loop over the _GET array to archive the user's inputs
foreach($_GET as $userinput => $inputvalue):
    if($userinput == 'passwd'){
        $nwords=$inputvalue;

        #echo "Number of words is".$inputvalue;
    }
    elseif ($userinput == 'numberoption'){
        $numbornot=$inputvalue;
        #echo 'you selected the numb opt';
    }
    elseif ($userinput == 'symboloption'){
        $symbornot = $inputvalue;
        #echo 'you selected the symb opt';
    }

endforeach;

/*===================================================
check for errors here
====================================================*/
$posswordnum = array("0","1","2","3","4","5","6","7","8");

if (!(in_array($nwords,$posswordnum))){
    if ($nwords == '' && $numbornot != 'yes' && $symbornot != 'yes'){
        $test_mess="Please provide atleast one of:number of words, include number,
        include symbol to generate a password (displaying default 5 word
        password)";
        $nwords='5';
    } elseif ($nwords != '' || (($numbornot =='yes')|| ($symbornot == 'yes'))) {
        $test_mess="invalid number of words value (displaying default 5 word
                    password with number/symbol if checked)";
        $nwords='5';
}
}


/*====================================================
now generate the password (word part)
======================================================*/
for ($i=0;$i<$nwords;$i++){
    $j=rand(0,count($wordlist)-1);

    if ($i == 0){
            $finpasswd = $finpasswd . $wordlist[$j];
    } else {
            $finpasswd = $finpasswd . '-'. $wordlist[$j];
    }

}

/*===============================================
now add the numbers and symbols if required
=================================================*/
if (in_array($nwords,$posswordnum)){
if ($numbornot == 'yes'){
    $k=rand(0,count($number)-1);
    $finpasswd = $finpasswd . $number[$k];
}
if ($symbornot == 'yes'){
    $l=rand(0,count($symb)-1);
    $finpasswd = $finpasswd . $symb[$l];
}
}

?>
