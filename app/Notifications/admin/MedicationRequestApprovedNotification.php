<?php

namespace App\Notifications\admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MedicationRequestApprovedNotification extends Notification
{
    use Queueable;

    private $request;
    private $supervisor;

    public function __construct($request, $supervisor)
    {
        $this->request    = $request;
        $this->supervisor = $supervisor;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array{
        return [
            'message'   => "The medication request of {$this->request->requested_quantity}
                            units of {$this->request->medication->name}
                            has been approved and sent to the pharmacy by supervisor {$this->supervisor->name}.",
            'request_id'    => $this->request->id,
            'medication_id' => $this->request->medication_id,
            'quantity'      => $this->request->requested_quantity,
            'supervisor_id' => $this->supervisor->id,
            'image'         => 'assets/img/approved.png',
            'url'           => route('notifications_description_read', $this->request->id),
        ];
    }
}

