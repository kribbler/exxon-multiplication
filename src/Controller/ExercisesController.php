<?php
namespace App\Controller;

use Cake\I18n\Time;
use Cake\I18n\FrozenTime;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class ExercisesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

        Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
        FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
        Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable Date
        FrozenDate::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable Date

    }

    public function getPrevious()
    {
        $exercises = $this->Exercises->find('all', array(
            'order' => array('id' => 'desc')
        ));
        $exercises = $exercises->toArray();

        $response = [];
        foreach ($exercises as $exercise) {
            $time = new Time($exercise['date']); 
            $date = $time->format('Y-m-d H:i:s');
            $response[] = array(
				'date' => $date,
				'total' => $exercise['total'],
				'correct' => $exercise['correct']
			);
        }

        $this->response->body(json_encode($exercises));
        return $this->response;
        die();
    }

    public function save()
    {
        if ($this->request->is('post')) {
            $this->autoRender=false;

            $response = $this->request->data;
            if (!$response['saved']) {
                //add
                $p = $this->Exercises->newEntity();
                $p->date = date('Y-m-d h:i:s');
                $p->total = 1;
                $p->correct = $response['correct'];

                $this->Exercises->save($p);
            } else {
                $p = $this->Exercises->find('all', array(
                    'order' => array('Exercises.id' => 'desc')
                ));

                $p = $p->first();
                $p->correct = $p->correct + $response['correct'];
                $p->total++;

                $this->Exercises->save($p);
                
            }
        }
        
        return $this->response;
    }
}
