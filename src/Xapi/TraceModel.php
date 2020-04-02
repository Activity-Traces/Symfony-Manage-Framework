<?php 
namespace App\Xapi;

class TraceModel
{
    /*************************************************************************************************************/
    
    private $timestamps;

    private $actor;
        private $actorObjectType;
        private $name; //m.lefevre
        private $mbox;//m.lefevre

    private $verb;
        private $verbid; // url/reponse
      //private $verbDisplay;
                private $verbDisplayTypeFR; // a repondu
                private $verbDisplayTypeEN; // a repondu



    private $object;
        private $objectId;
        private $objectType; // reponse
    //  private $objectDefinition;
            private $objectDefinitionType;
            private $objectDefinitionInteractionType;
            private $moreInfo;
            private  $choices; // cas d'un choix simple ou multiple
            private $source; // le cas d'un pair ou group item
            private $target;// le cas d'un pair ou group item



            private $objectDefinitionName;
                private $objectDefinitionNameType; // qcm ou autre chose (attempt)
                private $objectDefinitionNameTypeFR;
           
       //   private $objectDefinitionDescription;
                private $objectDefinitionDescriptionType;// qcm ou autre chose (attempt)
            
            private $obejectExtensions;

    private $result;
        private $completion;
        private $sucess;
    //  private $resultExtension;
            private $question;
            private $askedanswers;
            private $answsers;

            private $response;
                private $laquestion;
                private $attendue;
                private $areponde;
                private $correcte;

       
    //  private $obejectresultExtensions;
             private $scaled; // note

    private $statement;

    /*************************************************************************************************************/
    public function setTimestamps($timestamps)
    {
        $this->timestamps = $timestamps;
    }

    /*************************************************************************************************************/
    


    public function setActorObjectType($actorObjectType)
    {
        $this->actorObjectType = $actorObjectType;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function setMbox($mbox)
    {
        $this->mbox = $mbox;
    }

    /*************************************************************************************************************/
    
    public function setVerbid($verbid)
    {
        $this->verbid = $verbid;
    }

    public function setVerbDisplayTypeFR($verbDisplayTypeFR)
    {
        $this->verbDisplayTypeFR = $verbDisplayTypeFR;
    }



    public function setVerbDisplayTypeEN($verbDisplayTypeEN)
    {
        $this->verbDisplayTypeEN = $verbDisplayTypeEN;
    }

    /*************************************************************************************************************/

    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }
   
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;
    }
    
    public function setObjectDefinitionType($objectDefinitionType)
    {
        $this->objectDefinitionType = $objectDefinitionType;
    }
    

    public function setObjectDefinitionInteractionType($objectDefinitionInteractionType)
    {
        $this->objectDefinitionInteractionType = $objectDefinitionInteractionType;
    }
    

    public function setChoices($choices)
    {
      
        $this->choices = $choices;
    }

    public function setSource($source)
    {
      
        $this->source = $source;
    }


    public function setTarget($target)
    {
      
        $this->target = $target;
    }

    public function setMoreinfo($moreinfo)
    {
      
        $this->moreInfo = $moreinfo;
    }



    public function setObjectDefinitionName($objectDefinitionName)
    {
        $this->objectDefinitionName = $objectDefinitionName;
    }
    
    public function setObjectDefinitionNameType($objectDefinitionNameType)
    {
        $this->objectDefinitionNameType = $objectDefinitionNameType;
    }

    public function setObjectDefinitionNameTypeFR($objectDefinitionNameTypeFR)
    {
        $this->objectDefinitionNameTypeFR = $objectDefinitionNameTypeFR;
    }

    
    public function setObjectDefinitionDescriptionType($objectDefinitionDescriptionType)
    {
        $this->objectDefinitionDescriptionType = $objectDefinitionDescriptionType;
    }
    public function setObejectExtensions($obejectExtensions)
    
    {
        $this->obejectExtensions = $obejectExtensions;
    }

    /*************************************************************************************************************/

    public function setCompletion($completion)
    {
        $this->completion = $completion;
    }
    
    public function setSucess($sucess)
    
    {
        $this->sucess = $sucess;
    }
    
    public function setQuestion($question)
    {
        $this->question = $question;
    }
    
    public function setAskedAnswers($askedanswers)
    
    {
        $this->askedanswers = $askedanswers;
    }
    public function setAnswer($answsers)
    
    {
        $this->answsers = $answsers;
    }
       
    public function setScaled($scaled)
    {
        $this->scaled = $scaled;
    }

    public function setAttendue($attendue)
    {
        $this->attendue = $attendue;
    }

    public function setaReponde($reponde)
    {
        $this->repondre = $repondre;
    }

    public function setCorrecte($correcte)
    {
        $this->correcte = $correcte;
    }




    /*************************************************************************************************************/
    /*************************************************************************************************************/

    public function setActor()
    {
        $this->actor = 
        array(

            'objectType'=> $this->actorObjectType,
            'name'=>  $this->name,
            'mbox'=>  $this->mbox
        );

    }

    /*************************************************************************************************************/
    
    public function setVerb()
    {
        $this->verb = 
        array(

                'id'=>  $this->verbid,
               
                'display'=>array(
                    'en-EN'=> $this->verbDisplayTypeEN,
                    'fr-FR'=>  $this->verbDisplayTypeFR

                )
         );
    }

    /*************************************************************************************************************/
   
    public function setResponse()
    {
        $this->response = null;
    }

    /*************************************************************************************************************/
    
    public function setObject()
    {

    /*************************************************************************************************************/
        if  (   ($this->objectDefinitionNameType=='multiple-choice') or
                ($this->objectDefinitionNameType=='order-items')
            )
         {


            $this->object =  array(
                'id'=> $this->objectId,
                'objectType'=>$this->objectType,
                'definition'=>array(     
                            'name'=>array(
                                'en-EN'=>$this->objectDefinitionNameType,
                                'fr-FR'=>$this->objectDefinitionNameTypeFR
                            ),
                            'description'=>array(
                                'fr-FR'=>$this->objectDefinitionDescriptionType
                            ),
                            'type'=>$this->objectDefinitionType,
                            'interactionType'=>$this->objectDefinitionInteractionType,
                            'moreInfo'=>'http:/localhost/data/xAPI/statements/acvitities/moreinfo/'.$this->moreInfo,
                            'choices'=>$this->choices,
                            'correctResponsesPattern'=>$this->askedanswers         
                )
            );
        }
    /*************************************************************************************************************/

        if ($this->objectDefinitionNameType=='open-ended-question'){
                   $this->object =  array(
                    'id'=> $this->objectId,
                    'objectType'=>$this->objectType,
                    'definition'=>array(    
                                'name'=>array(
                                    'en-EN'=>$this->objectDefinitionNameType,
                                    'fr-FR'=>$this->objectDefinitionNameTypeFR
                                ),
                                'description'=>array(
                                    'fr-FR'=>$this->objectDefinitionDescriptionType
                                ),
                                'type'=>$this->objectDefinitionType,
                                'interactionType'=>$this->objectDefinitionInteractionType,
                                'moreInfo'=>'http:/localhost/data/xAPI/statements/acvitities/moreinfo/'.$this->moreInfo,
                                'correctResponsesPattern'=>$this->askedanswers         
                    )
                );
        }
    /*************************************************************************************************************/
       if (($this->objectDefinitionNameType=='pair-items') or 
           ($this->objectDefinitionNameType=='group-items')
       ){
                   $this->object =  array(
                        'id'=> $this->objectId,
                        'objectType'=>$this->objectType,
                        'definition'=>array(    
                                
                                'name'=>array(
                                    'en-EN'=>$this->objectDefinitionNameType,
                                    'fr-FR'=>$this->objectDefinitionNameTypeFR
                                ),
                                
                                'description'=>array(
                                    'fr-FR'=>$this->objectDefinitionDescriptionType
                                ),
                               
                                'source'=>$this->source,
                                'target'=>$this->target,
                                   
                                'type'=>$this->objectDefinitionType,
                                'interactionType'=>$this->objectDefinitionInteractionType,
                                'moreInfo'=>'http:/localhost/data/xAPI/statements/acvitities/moreinfo/'.$this->moreInfo,
                                'correctResponsesPattern'=>$this->askedanswers         
                    )
                );
        }
    /*************************************************************************************************************/
    }

    /*************************************************************************************************************/

    public function setResult()
    {
        $this->result = 
                        array(

                            'completion'=>$this->completion,
                            'success'=>$this->sucess,
                            'response'=>$this->answsers,

                            'score'=>array(
                                'scaled'=>$this->scaled/100
                            ),

                            'extensions'=>array(
                                'http:/localhost/data/xAPI/statements/result/correct'=> $this->correcte 
                            )                               
                        );
    }


   
    /*************************************************************************************************************/

    public function getStatement()
    {
        return $this->statement;
    }

    public function setStatement()
    {
        $this->statement = 
                        
                            array(
                                    
                                    'actor'=>   $this->actor,
                                    'verb'=>  $this->verb,
                                    'object'=>  $this->object,
                                    'result'=>  $this->result
                                    
                             );
        
    }


}

?>