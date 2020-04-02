<?php

namespace App\Controller;

use App\Xapi\TraceModel;
use Symfony\Component\Filesystem\Filesystem;

use Symfony\Component\Serializer\Serializer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/************************************************************************************************************** */
class XapiController extends AbstractController
{


/**
 * @Route("/json", name="jsondecodes")
 */
    
public function PutInXAPIModel()
    {

/***************************************************************************************************************/


//$filesystem->mkdir('temp/ttt', 0700);

//$js = file('fichier.json');
//$json_data = json_decode($json_source);
//foreach ($js as $line){
    //dump($line);
 //   $j=json_decode($line);
 //   dump($j->actor);
//}
/*
$answer='{
    "content": [0, 0, 0, 0]
}';

$itemcontent='{
    "wording": "R\u00e9pondez aux questions suivantes :",
    "documents": [],
    "item_count": 1,
    "exercise_type": "multiple-choice"
}';

$exrciceContent=
'
{
    "comment": "",
    "question": "L instruction \"tant que\"",
    "propositions": [{
        "text": "s utilise dans une boucle ou\u0300 l on connai\u0302t a\u0300 l avance le nombre d ite\u0301rations",
        "right": false
    }, {
        "text": "s utilise dans une boucle ou\u0300 l on ne connai\u0302t pas a\u0300 l avance le nombre d ite\u0301rations",
        "right": true
    }, {
        "text": "n est pas une boucle",
        "right": false
    }, {
        "text": "s utilise dans une boucle inconditionnelle",
        "right": false
    }],
    "origin_resource": 702,
    "item_type": "multiple-choice-question"
}
';



$answer=json_decode($answer);
$itemcontent=json_decode($itemcontent);
$exrciceContent=json_decode($exrciceContent);
$propositions=$exrciceContent->propositions;


dump($answer);
dump($itemcontent);
dump($exrciceContent);
dump($propositions);

$questions[]=$itemcontent->wording.'\n';
$questions[]=$exrciceContent->question;


for($i = 0; $i < sizeof($propositions);$i++) {
    $questions[]=strip_tags($propositions[$i]->text);
    $askedAnswers[]=$propositions[$i]->right ;
    if($answer->content[$i]==0)
        $learnerAnswers[]=false;
    else
        $learnerAnswers[]=true;
}



dump($questions);
dump($askedAnswers);
dump($learnerAnswers);
//dump($$propositions);


/*
$solutions=$exrciceContent->solutions;

for($i = 0; $i < sizeof($propositions);$i++)

    $groupiemscase[]=strip_tags($propositions[$i]->text).'  '.$propositions[$i]->right ;


$itemcontent->wording;
dump($groupiemscase);





*/






/****************************************************************************************************************/

/* les questions de type: group item*/
 /*   $answer='{
        "content": {
            "obj": [0, 0, 0],
            "gr": ["Vrai", "Faux"]
        }
    }';

    // à supprimer les tirets de la phrase

    $itemcontent=
    '{
        "wording": "Que vaut l \u00e9valuation de l expression \"X ET Y\" pour chaque couple ci-dessous.",
        "documents": [],
        "item_count": 1,
        "exercise_type": "group-items"
    }';

    $exrciceContent='
    {
    "display_group_names": "ask",
    "objects": [{
            "origin_resource": 48,
            "text": "<p>X = Vrai<\/p><p>Y = Faux<\/p>",
            "object_type": "text"
        },
        {
            "origin_resource": 47,
            "text": "<p>X = Faux<\/p><p>Y = Vrai<\/p>",
            "object_type": "text"
        },
        {
            "origin_resource": 45,
            "text": "<p>X = Vrai<\/p><p>Y = Vrai<\/p>",
            "object_type": "text"
        }
    ],
    "groups": ["Faux", "Vrai"],
    "solutions": [0, 0, 1],
    "item_type": "group-items"
}';

    
    $answer=json_decode($answer);
    $itemcontent=json_decode($itemcontent);
    $exrciceContent=json_decode($exrciceContent);
    $propositions=$exrciceContent->objects;
    $solutions=$exrciceContent->solutions;

    for($i = 0; $i < sizeof($propositions);$i++)

    if($solutions[$i]==0)
        $groupiemscase[]=strip_tags($propositions[$i]->text).'  solution: Faux';
    else
        $groupiemscase[]=strip_tags($propositions[$i]->text).'  solution: Vrai';
    $itemcontent->wording;
    dump($groupiemscase);
*/
   /****************************************************************************************************************/
 


   $a='{"content":[0,0,0,1]}';


    $b='"{"comment":"","question":"L instruction \"tant que\,
    "propositions":[{"text":"s utilise dans une boucle inconditionnelle",
    "right":false},{"text":"n est pas une boucle","right":false},
    {"text":"s utilise dans une boucle ou\u0300 l on ne connai\u0302t pas a\u0300
    l avance le nombre dit e\u0301rations","right":true},{"text":"s utilise dans une boucle ou\u0300 
    l on connai\u0302t a\u0300 l avance le nombre d ite\u0301rations","right":false}],
    "origin_resource":702,"item_type":"multiple-choice-question"}"';


    $c='"{"wording":"R\u00e9pondez aux questions suivantes :","documents":[],"item_count":3,"exercise_type":"multiple-choice"}"';


    $answer=json_decode($a);
    $itemcontent=json_decode($b);
    $exrciceContent=json_decode($c);
    dump($answer);
    dump($itemcontent);
    dump($exrciceContent);













   
        return $this->render('xapi/index.html.twig', [
            'json' => $xapiJson
        ]);
    }


}
