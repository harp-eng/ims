<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class IngredientNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ingredient;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Ingredient $ingredient
     */
    public function __construct($ingredient)
    {
        $this->ingredient = $ingredient;
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
            'ingredient_id' => $this->ingredient->id,
            'description' => $this->ingredient->description,
            'message' => 'Ingredient :'.$this->ingredient->name.' status is changed '.$this->ingredient->status.' take action accordingly',
            'title' => 'Status Changed of '.$this->ingredient->name.' to '.$this->ingredient->status,
            'text' => 'Ingredient :'.$this->ingredient->name.' status is changed '.$this->ingredient->status.' take action accordingly',
            'url_backend' => url('/admin/ingredient/' . $this->ingredient->id), // Add backend URL if necessary or remove if not used
            'url_frontend' => '', // Add frontend URL if necessary or remove if not used
            'module' => 'ingredient', // Fixed missing key and provided a value
            'action_url' => url('/admin/ingredient/' . $this->ingredient->id),
        ];
    }
}
