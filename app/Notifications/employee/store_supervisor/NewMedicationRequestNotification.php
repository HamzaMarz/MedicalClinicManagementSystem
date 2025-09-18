<?php

namespace App\Notifications\store_supervisor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMedicationRequestNotification extends Notification
{
    use Queueable;

    private $requestId;
    private $medication;
    private $quantity;
    private $admin;

    /**
     * Create a new notification instance.
     */
    public function __construct($requestId, $medication, $quantity, $admin)
    {
        $this->requestId  = $requestId;
        $this->medication = $medication;
        $this->quantity   = $quantity;
        $this->admin      = $admin;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "📦 New request: {$this->quantity} units of {$this->medication->name} requested by Admin to be delivered to the pharmacy",
            'request_id' => $this->requestId,
            'medication_id' => $this->medication->id,
            'requested_quantity' => $this->quantity,
            'admin_id' => $this->admin->id,
            'image' => 'assets/img/request.png',
            'url'                => route('notifications_description_request_read', $this->requestId),
        ];
    }
}
