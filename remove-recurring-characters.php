<?php 

include './start.php'; 
//include './person.php'; 

function removeConsecutiveChar(String $string){


    $a = str_split($string); // convert string to array 

    $b = array(); // initialize new container that will hold final array 
    $current = array_pop($a); // holds current character that is being compared
    $aCount = count($a); //  original array count
    $bCount = count($b); // new array count
    array_push( $b, $current );
    
    $consecutiveCount = 1;  // holds the consecutive number of records , initialized to 1 after initial push


    // while the original array is not empty, 
    // compare the last character of the original (A) 
    // with the last character of the new array (B). 
   
    while( !empty($a)){
        
        // If they are equal, pop the last character in original array and push onto new array. 
        // Then update consecutiveCount, new array, and original array accordingly 
        
        if( $b[$bCount-1] == $a[$aCount-1] ) {

            $consecutiveCount++;
            $current = array_pop($a);
            array_push($b,$current);
            $bCount = count($b);
            $aCount = count($a);

        }

        else{

            // if the last characters are not equal, check if the consecutiveCount is greater than 2.  
            // If it is not, reset consecutiveCount to 1 since there is not 3 consecutive 
            // and the new character will be added.

            if( $consecutiveCount <= 2 ) {
                $consecutiveCount = 1;
            }
            else {  // pop all consecutive characters from new array
                while( $consecutiveCount != 0 ){
                    array_pop($b);
                    $consecutiveCount--;
                }

                $bCount = count($b);

                $consecutiveCount = 1;
            }

           // after popping all consecutive, check if the previous two chars
           // (which is the maximum consecutive size that could exist on the new array) 
           // on the new array match the next char to be compared on the original array.  
           // if they do match, update the consecutiveCount to 3
           // else if the last char of new and original match, set to 2       
           // otherwise, reset to 1  

            if( $b[$bCount-1] == $b[$bCount-2] && $b[$bCount-2] == $a[$aCount-1] ){

                $consecutiveCount = 3;

            }

            elseif( $b[$bCount-1] == $a[$aCount-1]){
                
                $consecutiveCount = 2; 
            
            }
            
            else { 
            
                $consecutiveCount = 1;
            }

            $current = array_pop($a);
            array_push($b,$current);
            $bCount = count($b);
            $aCount = count($a);
           
        }
    }


    // checks if the remaining chars in the new array are consecutive after we exit the while loop.
    if( $consecutiveCount >= 3 ) {

            while( $consecutiveCount != 0) {
            array_pop($b);
            $consecutiveCount--;

        }
    }

    echo 'Original String:';
    print_r($string);
    echo '<br/><br/>';

    echo 'Final String:';
    print_r(implode("",array_reverse($b)));
    echo '<br/><br/>';

}

// TESTS

removeConsecutiveChar( "ZZGOOXXXXOOGG" ); // outputs ZZ
removeConsecutiveChar( "ABCDEF" ); // outputs ABCDEF
removeConsecutiveChar( "OOXXXXOOGG"); // outputs GG
removeConsecutiveChar( "GOOXXXXOOGG"); // outputs empty
removeConsecutiveChar( "GGAOOXXXXOOGG"); // outputs GGAGG
removeConsecutiveChar( "XXAABBCCCCBBBBBBBAX"); // outputs XXAABBAX
removeConsecutiveChar( "XXAABBCCCCBBAX"); // outputs empty 


// take a string and remove all consecutive characters greater than 2
// "GGAOOXXXXOOGG" should return GGAGG
//

include './end.php'; 
?>
