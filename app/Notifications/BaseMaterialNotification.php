<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class BaseMaterialNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $basematerial;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Ingredient $basematerial
     */
    public function __construct($basematerial)
    {
        $this->basematerial = $basematerial;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'basematerial_id' => $this->basematerial->id,
            'description' => $this->basematerial->description,
            'message' => 'Ingredient :' . $this->basematerial->name . ' status is changed ' . $this->basematerial->status . ' take action accordingly',
            'title' => 'Status Changed of ' . $this->basematerial->name . ' to ' . $this->basematerial->status,
            'text' => 'Ingredient :' . $this->basematerial->name . ' status is changed ' . $this->basematerial->status . ' take action accordingly',
            'url_backend' => url('/admin/basematerials/' . $this->basematerial->id), // Add backend URL if necessary or remove if not used
            'url_frontend' => '', // Add frontend URL if necessary or remove if not used
            'module' => 'basematerial', // Fixed missing key and provided a value
            'action_url' => url('/admin/basematerials/' . $this->basematerial->id),
        ];
    }
}
