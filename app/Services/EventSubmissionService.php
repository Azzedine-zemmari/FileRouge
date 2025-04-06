<?php

namespace App\Services;

use App\Repositories\Contracts\EventSubmissionInterface;

class EventSubmissionService{
    private $eventsubmissionRepository;
    public function __construct(EventSubmissionInterface $eventsubmissionRepository)
    {
        $this->eventsubmissionRepository = $eventsubmissionRepository;
    }
    
    // to show event for the admin
    public function showEvents(){
        return $this->eventsubmissionRepository->getAll();
    }
    public function acceptEvent(int $id){
        return $this->eventsubmissionRepository->updateSatatus($id,'accept');
    }
    public function refuseEvent(int $id){
        return $this->eventsubmissionRepository->updateSatatus($id,'refuse');
    }
    // to show for the final user
    public function showSubmitedEvents(){
        return $this->eventsubmissionRepository->getSubmitedEvents();
    }
}