<?php


namespace App\Censurator;


class Censurator
{


    public function purify(string $textToCensure): string
    {
        $bannedWords = array('moche', 'nain', 'cafard', 'pauvre');

        $charReplacement= '*';
        $textcensured="";
        $tabWordIn = explode( " ",$textToCensure);
        //dump($tabWordIn);

        // decouper en mot => tableau
        $textcensured = strtoupper($textToCensure);

        // boucler et comparer au tableau interdit si ok
        for ($j=0; $j<sizeof($tabWordIn); $j++){

            $word= $tabWordIn[$j];


            foreach ($bannedWords as $banned)
            {

                if( $banned===$word)
                {
                    //dump($word);

                    // remplacement des caracteres du mot trouvé par des etoiles
                    $tabChar = str_split($word);


                    for ( $i=0; $i<sizeof($tabChar) ; $i++ )
                 {
                     $tabChar[$i] = $charReplacement;

                  }
                    dump($tabChar);

                    $newWord= implode($tabChar);
                    dump($newWord);



                    // ecraser la valeur du tableau contenant l'ensemble des mots descriptifs de l'idee
                    $tabWordIn[$j]= $newWord;


                }

            }


        }

        $newdescription = implode(" ",$tabWordIn);

        dump($newdescription);


        // recuperer le mot et le remplcaer par caractere


        return  $newdescription;

    }

}